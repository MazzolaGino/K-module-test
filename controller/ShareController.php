<?php
use KLib\Base\BaseController;

class ShareController extends BaseController
{

    public function __construct()
    {
        parent::__construct(TestBuilder::getInstance());
    }

    public function index_action(): void
    {
        $structure = $this->save($this->app->getCnf()
            ->get('share_options'));

        $this->render('index', [
            'values' => $structure,
            'referer' => 'admin.php?page=k-module-test-share-index'
        ]);
    }
}