<?php if ( ! defined( 'ABSPATH' ) ) exit;

/*
 * Plugin Name: Backtick Highlighter
 * Plugin URI: http://kylebjohnson.me
 * Description: Highlight text inside of `backticks`, like Slack.
 * Version: 0.0.0.0.1
 * Author: Kyle B. Johnson
 * Author URI: http://kylebjohnson.me
 */

class KBJ_Backtick_Highlighter
{

    public function __construct()
    {
        add_filter( 'the_content', array( $this, 'backtick_highlight' ) );
    }

    function backtick_highlight( $content )
    {
        preg_match_all('/`([^`]+)`/', $content, $matches);

        if (!empty($matches[0])) {
            foreach ($matches[0] as $match) {
                $new_text = substr($match, 1);
                $new_text = substr($new_text, 0, -1);

                $content = str_replace($match, '<span style="color: #EF4748;background-color: #f1f1f1;padding: .5em;">' . $new_text . '</span>', $content);
            }
        }

        return $content;
    }


}

new KBJ_Backtick_Highlighter();
