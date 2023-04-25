<?php
use KLib\Base\BaseProcessor;

class ShareProcessor extends BaseProcessor
{

    public function __construct()
    {
        parent::__construct(TestBuilder::getInstance());
    }

    /**
     *
     * @hook transition_post_status
     * @priority 10
     * @args 3
     */
    public function index_processor($new_status, $old_status = null, $post = null)
    {
        if (! $post || ! $old_status || ! $new_status) {
            return;
        }

        $connections = [
            new SnFacebookConnection($post, $old_status, $new_status),
            new SnTwitterConnection($post, $old_status, $new_status),
            new SnDiscordConnection($post, $old_status, $new_status)
        ];

        $canPost = true;
        foreach ($connections as $connection) {
            if (! $connection->canPost()) {
                $canPost = false;
                break;
            }
        }

        if ($canPost) {
            $ptsn = new SnPostToSocialNetwork($connections);
            $ptsn->executePosts();
        }
    }

    /**
     *
     * @hook add_meta_boxes
     */
    public function shareDisplayCustomPosts_processor($post)
    {
        add_meta_box('champs_personnalises', 'Textes pour les réseaux sociaux', [
            $this,
            'customFields'
        ], 'post', 'normal', 'high');
    }

    public function customFields($post)
    {
        $fields = [
            [
                'label' => 'Texte Twitter:',
                'name' => 'texte_twitter'
            ],
            [
                'label' => 'Texte Facebook:',
                'name' => 'texte_facebook'
            ],
            [
                'label' => 'Texte Discord:',
                'name' => 'texte_discord'
            ]
        ];

        foreach ($fields as $field) {
            $value = get_post_meta($post->ID, $field['name'], true) ?? '';

            echo "<label for=\"{$field['name']}\">{$field['label']}</label><br>";
            echo "<textarea id=\"{$field['name']}\" name=\"{$field['name']}\" rows=\"4\" cols=\"50\">{$value}</textarea><br>";
        }
    }

    /**
     *
     * @hook save_post
     */
    public function shareSaveCustomPosts_processor($post_id)
    {
        $fields = [
            'texte_twitter',
            'texte_facebook',
            'texte_discord'
        ];

        foreach ($fields as $field) {
            if (array_key_exists($field, $_POST)) {
                try {
                    update_post_meta($post_id, $field, $_POST[$field]);
                } catch (Exception $e) {
                    // Handle the exception as appropriate
                }
            }
        }
    }

    /**
     *
     * @hook admin_enqueue_scripts
     */
    public function hidePublishButton_processor()
    {
        $current_screen = get_current_screen();

        if ($current_screen->base === 'post' || $current_screen->base === 'post-new') {

            $this->scripts->enqueue('publish-js');
        }
    }
}