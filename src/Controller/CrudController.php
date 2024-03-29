<?php

namespace AlexanderA2\PlatformBundle\Controller;

use AlexanderA2\PhpDatasheet\Helper\StringHelper;
use AlexanderA2\PlatformBundle\Builder\EntityDataBuilder;
use AlexanderA2\PlatformBundle\Builder\EntityDatasheetBuilder;
use AlexanderA2\PlatformBundle\Builder\EntityFormBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Contracts\Translation\TranslatorInterface;
use Throwable;

#[IsGranted('ROLE_ADMIN')]
#[Route("admin/crud/", name: "admin_crud_")]
class CrudController extends AbstractController
{
    #[Route("index", name: "index")]
    public function indexAction(
        Request                $request,
        EntityDatasheetBuilder $entityDatasheetBuilder,
        TranslatorInterface    $translator,

    ): Response {
        $entityClassName = $request->get('entityClassName');

        return $this->render('@Platform/crud/index.html.twig', [
            'pageTitle' => $translator->trans('a2platform.admin.crud.index.page_title', [
                '%entityName%' => StringHelper::getShortClassName($entityClassName),
            ]),
            'entityDatasheet' => $entityDatasheetBuilder->build($entityClassName),
            'entityClassName' => $entityClassName,
        ]);
    }

    #[Route("view", name: "view")]
    public function viewAction(
        Request                $request,
        EntityManagerInterface $entityManager,
        EntityDataBuilder      $entityDataBuilder,
        TranslatorInterface    $translator,
    ): Response {
        $entityClassName = $request->get('entityClassName');
        $entityId = $request->get('entityId');
        $entity = $entityManager->getRepository($entityClassName)->find($entityId);

        return $this->render('@Platform/crud/view.html.twig', [
            'pageTitle' => $translator->trans('a2platform.admin.crud.view.page_title', [
                '%entityName%' => StringHelper::getShortClassName($entityClassName),
                '%entityId%' => $entityId,
            ]),
            'entity' => $entity,
            'data' => $entityDataBuilder->getData($entity),
            'entityClassName' => $entityClassName,
            'entityId' => $entityId,
        ]);
    }

    #[Route("edit", name: "edit")]
    public function editAction(
        Request                $request,
        EntityManagerInterface $entityManager,
        EntityFormBuilder      $formBuilder,
        TranslatorInterface    $translator,
    ): Response {
        $entityClassName = $request->query->get('entityClassName');
        $entityId = $request->query->get('entityId');

        if ($entityId) {
            $entity = $entityManager->getRepository($entityClassName)->find($entityId);
        } else {
            $entity = new $entityClassName;
        }

        $form = $formBuilder->get($entity);
        $form->setData($entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                if (!$entityId) {
                    $entityManager->persist($entity);
                }
                $entityManager->flush();
                $this->addFlash('success', $entityId ? 'admin.entity.crud.record_was_updated' : 'admin.entity.crud.record_was_created');
            } catch (Throwable $exception) {
                $this->addFlash('error', 'admin.something_went_wrong');
            }

            return $this->redirectToRoute('admin_crud_view', [
                'entityClassName' => $entityClassName,
                'entityId' => $entity->getId(),
            ]);
        }

        return $this->render('@Platform/crud/edit.html.twig', [
            'pageTitle' => $translator->trans($entityId ? 'a2platform.admin.crud.edit.page_title' : 'a2platform.admin.crud.create.page_title', [
                '%entityName%' => StringHelper::getShortClassName($entityClassName),
                '%entityId%' => $entityId,
            ]),
            'form' => $form->createView(),
            'entityClassName' => $entityClassName,
            'entityId' => $entityId ?? null,
        ]);
    }

    #[Route("delete", name: "delete")]
    public function deleteAction(
        Request                $request,
        EntityManagerInterface $entityManager,
    ): Response {
        $entityClassName = $request->query->get('entityClassName');
        $entityId = $request->query->get('entityId');
        $entity = $entityManager->getRepository($entityClassName)->find($entityId);

        try {
            $entityManager->remove($entity);
            $entityManager->flush();
            $this->addFlash('success', 'admin.entity.crud.record_was_deleted');
        } catch (Throwable $exception) {
            $this->addFlash('error', 'admin.something_went_wrong');
        }

        return $this->redirectToRoute('admin_crud_index', [
            'entityClassName' => $entityClassName,
        ]);
    }
}