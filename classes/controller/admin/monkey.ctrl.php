<?php
/**
 * NOVIUS OS - Web OS for digital communication
 *
 * @copyright  2011 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */

namespace Nos\Monkey;

use Nos\Controller;

class Controller_Admin_Monkey extends \Nos\Controller_Admin_Crud {

    protected function crud_item($id)
    {
        return $id === null ? Model_Monkey::forge() : Model_Monkey::find($id);
    }

    public function action_form($id = null) {

        $date = new \Date();
        $date = $date->format('%Y-%m-%d %H:%M:%S');

        if ($id === null) {
            $item = Model_Monkey::forge();
            $item->author = \Session::user();
            $item->item_lang = \Input::get('lang', key(\Config::get('locales')));
            $item->item_created_at = $date;
        } else {
            $item = Model_Monkey::find($id);
        }

        $is_new = $item->is_new();


        if ($is_new) {
            $create_from_id = \Input::get('create_from_id', 0);
            if (empty($create_from_id)) {
                $item                 = Model_Monkey::forge();
                $item->item_lang_common_id = \Input::get('common_id');
            } else {
                $object_from = Model_Monkey::find($create_from_id);
                $item      = clone $object_from;
                $item->tags = $object_from->tags;

                //$item->wysiwygs = new \Nos\Orm\Model_Wysiwyg_Provider($item);
                //\Debug::dump($item->wysiwygs->content);

                //$item->wysiwygs->content = $object_from->wysiwygs->content; //$wysiwyg;
            }
            $item->item_lang = \Input::get('lang');
            $item->author = \Session::user();
            $item->item_created_at = $date;
        }


        $fields = \Config::load('noviusos_monkey::controller/admin/form', true);
        \Arr::set($fields, 'author->cat_fullname.form.value', $item->author->fullname());

        if ($is_new || \Input::post('item_lang', false) != false) {
            $fields = \Arr::merge($fields, array(
                'item_lang' => array(
                    'form' => array(
                        'type' => 'hidden',
                        'value' => \Input::get('lang'),
                    ),
                ),
                'item_lang_common_id' => array(
                    'form' => array(
                        'type' => 'hidden',
                        'value' => $item->item_lang_common_id,
                    ),
                ),
                'save' => array(
                    'form' => array(
                        'value' => __('Add'),
                    ),
                ),
            ));
        }

        $fieldset = \Fieldset::build_from_config($fields, $item, array(
            'success' => function($object, $data) use ($is_new, $item) {
                $return = array(
                    'notify' =>  $is_new ? __('Post successfully added.') : __('Post successfully saved.'),
                    'dispatchEvent' => array(
                        'name' => get_class($item),
                        'action' => $is_new ? 'insert' : 'update',
                        'id' => $item->item_id,
                        'lang_common_id' => $item->item_lang_common_id,
                        'lang' => $item->item_lang,
                    ),
                );
                if ($is_new) {
                    $return['replaceTab'] = 'admin/noviusos_monkey/form/crud/'.$object->item_id;
                }
                return $return;
            },
        ));

        $fieldset->js_validation();

        return \View::forge('noviusos_monkey::form/form', array(
            'item'     => $item,
            'url_crud'  => 'admin/noviusos_monkey/item/crud',
            'fieldset' => $fieldset,
            'lang'     => $item->item_lang,
            'tabInfos' => $this->get_tabInfos($item),
        ), false);
    }
}