<?php

namespace Cekurte\TwitterLike\Controller\Api;

use Cekurte\ResourceManager\Exception\ResourceManagerRefusedWriteException;
use Cekurte\ResourceManager\ResourceManager;
use Cekurte\TwitterLike\Controller\AbstractController;
use Cekurte\TwitterLike\Entity\Post;
use Cekurte\TwitterLike\Response\ConstraintViolationResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends AbstractController
{
    protected function getResourceManager()
    {
        return ResourceManager::create('doctrine', [
            'em'     => $this->getApp()['orm.em'],
            'entity' => '\Cekurte\TwitterLike\Entity\Post'
        ]);
    }

    public function indexAction(Request $request)
    {
        $resources = $this->getResourceManager()->findResources();

        $format = in_array('text/xml', $request->getAcceptableContentTypes()) ? 'xml' : 'json';

        return new Response($this->getApp()['serializer']->serialize($resources, $format), 200, [
            'Content-Type' => $request->getMimeType($format)
        ]);
    }

    public function createAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['message'])) {
            return new JsonResponse([
                'The message field is required.'
            ], 400);
        }

        $resource = new Post();
        $resource->setMessage($data['message']);

        $errors = $this->getApp()['validator']->validate($resource);

        if (count($errors) > 0) {
            return new ConstraintViolationResponse($errors);
        }

        try {
            $this->getResourceManager()->writeResource($resource);

            $format = in_array('text/xml', $request->getAcceptableContentTypes()) ? 'xml' : 'json';

            return new Response($this->getApp()['serializer']->serialize($resource, $format), 200, [
                'Content-Type' => $request->getMimeType($format)
            ]);
        } catch (ResourceManagerRefusedWriteException $e) {
            return new Response($e->getMessage(), 400);
        }
    }
}
