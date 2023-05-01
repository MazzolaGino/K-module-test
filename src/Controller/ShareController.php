<?php
namespace KLibPlugin\Controller;


class ShareController extends Controller
{

    public function index_action(): void
    {
        $structure = $this->save($this->getApp()->getCnf()
            ->get('share_options'));

        $this->render('index', [
            'values' => $structure,
            'referer' => 'admin.php?page=k-module-test-share-index'
        ]);
    }


}