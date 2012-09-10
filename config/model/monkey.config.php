<?php
/**
 * NOVIUS OS - Web OS for digital communication
 *
 * @copyright  2011 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */
return array(

    'behaviours'   => array(
        'Nos\Orm_Behaviour_Sharable' => array(
            'data' => array(
                \Nos\DataCatcher::TYPE_TITLE => array(
                    'value' => 'monk_name',
                    'useTitle' => __('Use monkey name'),
                ),
                \Nos\DataCatcher::TYPE_URL => array(
                    'value' => function($monkey) {
                        $urls = $monkey->urls();
                        if (empty($urls)) {
                            return null;
                        }
                        reset($urls);

                        return key($urls);
                    },
                    'options' => function($post) {
                        return $post->urls();
                    },
                ),
                \Nos\DataCatcher::TYPE_TEXT => array(
                    'value' => function($monkey) {
                        return $monkey->monk_summary;
                    },
                    'useTitle' => __('Use monkey summary'),
                ),
                \Nos\DataCatcher::TYPE_IMAGE => array(
                    'value' => function($monkey) {
                        $possible = $monkey->possible_medias();

                        return Arr::get(array_keys($possible), 0, null);
                    },
                    'possibles' => function($monkey) {
                        return $monkey->possible_medias();
                    },
                ),
            ),
        ),
    ),
);
