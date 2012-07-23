/**
 * NOVIUS OS - Web OS for digital communication
 *
 * @copyright  2011 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */

define([
    'jquery-nos'
], function($) {
    return function(appDesk) {
        return {
            tab : {
                label : appDesk.i18n('Monkey'),
                iconUrl : 'static/apps/noviusos_monkey/img/32/monkey.png'
            },
            actions : {
                update : {
                    action : function(item, ui) {
                        $(ui).nosTabs({
                            url     : "admin/noviusos_monkey/monkey/crud/" + item.id,
                            label   : appDesk.i18n('Edit')._()
                        });
                    },
                    label : appDesk.i18n('Edit'),
                    name : 'edit',
                    primary : true,
                    icon : 'pencil'
                },
                'delete' : {
                    action : function(item, ui) {
                        $.appDesk = appDesk;
                        $(ui).nosConfirmationDialog({
                            contentUrl: 'admin/noviusos_monkey/appdesk/delete/' + item.id,
                            title: appDesk.i18n('Delete a monkey')._(),
                            confirmed: function($dialog) {
                                $dialog.nosAjax({
                                    url : 'admin/noviusos_monkey/appdesk/delete_confirm',
                                    method : 'POST',
                                    data : $dialog.find('form').serialize()
                                });
                            },
                            appDesk: appDesk
                        });
                    },
                    label : appDesk.i18n('Delete'),
                    name : 'delete',
                    primary : true,
                    icon : 'trash'
                },
                'visualise' : {
                    label : 'Visualise',
                    name : 'visualise',
                    primary : true,
                    iconClasses : 'nos-icon16 nos-icon16-eye',
                    action : function(item) {
                        window.open(item.url + '?_preview=1');
                    }
                }
            },
            reloadEvent : 'Nos\\Application\\Model_Monkey',
            appdesk : {
                adds : {
                    monkey : {
                        label : appDesk.i18n('Add a monkey'),
                        action : function(ui, appdesk) {
                            $(ui).nosTabs('add', {
                                url     : 'admin/noviusos_monkey/monkey/crud?lang=' + appdesk.lang,
                                label   : appDesk.i18n('Add a new monkey')._()
                            });
                        }
                    },
                    breed : {
                        label : appDesk.i18n('Add a breed'),
                        action : function(ui, appdesk) {
                            $(ui).nosTabs({
                                url: 'admin/noviusos_monkey/breed/crud?lang=' + appdesk.lang,
                                label: 'Add a breed'
                            });
                        }
                    }
                },
                splittersVertical :  250,
                grid : {
                    proxyUrl : 'admin/noviusos_monkey/appdesk/json',
                    columns : {
                        name : {
                            headerText : appDesk.i18n('Name'),
                            dataKey : 'name'
                        },
                        lang : {
                            lang : true
                        },
                        breed : {
                            headerText : appDesk.i18n('Breed'),
                            dataKey : 'breed'
                        },
                        published : {
                            headerText : appDesk.i18n('Status'),
                            dataKey : 'publication_status'
                        },
                        actions : {
                            actions : ['update', 'delete', 'visualise']
                        }
                    }
                },
                inspectors : {
                    breeds : {
                        reloadEvent : 'Nos\\Model_Breed',
                        label : appDesk.i18n('Breeds'),
                        url : 'admin/noviusos_monkey/inspector/breed/list',
                        grid : {
                            columns : {
                                title : {
                                    headerText : appDesk.i18n('Breed'),
                                    dataKey : 'title'
                                }
                            },
                            urlJson : 'admin/noviusos_monkey/inspector/breed/json'
                        },
                        inputName : 'monk_breed_id[]',
                        vertical : true
                    }
                }
            }
        }
    }
});
