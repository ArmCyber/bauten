<?php
namespace App\Http\Controllers\Admin;

use App\Services\Notify\Facades\Notify;
use Illuminate\Support\Facades\Gate;
use Zakhayko\Banners\RenderBanners;

class BannersController extends BaseController
{
    //region Private
    use RenderBanners;

    public function beforeRender($page) {
        if (array_key_exists($page, $this->gates) && !Gate::check($this->gates[$page])) abort(403);
    }

    protected function set_image($settings, $input, $banner){
        if (empty($settings['original_file'])) {
            $resize = [];
            if (array_key_exists('resize', $settings)) {
                $resize[] = [
                    'method'=>$settings['resize'][0],
                    'width'=>$settings['resize'][1],
                    'height'=>$settings['resize'][2],
                    'upsize'=>empty($settings['resize'][3])?false:true,
                    'aspectRatio'=>$settings['resize'][4]??false,
                ];
            }
            else $resize[] = ['method'=>'original'];
            if ($input && $input->isFile() &&
                $image = upload_image($input, config('banners.upload_dir'), $resize, !empty($banner)?$banner:false)

            ) return $image;
        }
        else {
            if ($input && $input->isFile() && $image = upload_original_image($input, config('banners.upload_dir'), !empty($banner)?$banner:false)) return $image;
        }
        return $banner;
    }

    protected function set_labelauty($settings, $input, $banner) {
        return $input?true:false;
    }

    protected function beforeSave($page){
        Notify::get('changes_saved');
    }
    //endregion
    protected $gates = [
    ];

    protected $settings = [
        'info' => [
            'data' => [
                'params' => [
                    'logo' => [
                        'type'=>'image',
                        'original_file'=>'true',
                    ],
                    'logo_footer' => [
                        'type' => 'image',
                        'original_file' => 'true',
                    ],
                    'email' => 'input',
                    'seo_suffix' => 'input'
                ]
            ],
            'requisites' => [
                'count'=>4,
                'params' => [
                    'address' => 'input',
                    'phone' => 'input',
                    'email' => 'input',
                ]
            ],
            'socials' => [
                'count' => 4,
                'params' => [
                    'icon' => [
                        'type' => 'image',
                        'original_file' => true,
                    ],
                    'title' => 'input',
                    'url' => 'input',
                    'active' => 'labelauty',
                ]
            ],
            'payment_logos' => [
                'count' => 4,
                'params' => [
                    'logo' => [
                        'type' => 'image',
                        'original_file' => true,
                    ],
                    'title' => 'input',
                    'alt' => 'input',
                    'active' => 'labelauty',
                ]
            ],
        ],
        'home' => [
            'block_titles' => [
                'params' => [
                    'catalogue' => 'input',
                    'parts' => 'input',
                    'brands' => 'input',
                    'news' => 'input',
                    'recommended_parts' => 'input',
                ]
            ],

            'banners' => [
                'count' => 2,
                'params' => [
                    'image' => [
                        'type'=>'image',
                        'resize' => ['fit', 750, 250, true],
                    ],
                    'url' => 'input',
                    'alt' => 'input',
                    'title' => 'input',
                    'active' => 'labelauty',
                ]
            ],
        ],
        'contacts' => [
            'data' => [
                'params' => [
                    'requisites_title' => 'input',
                    'form_title' => 'input',
                    'iframe' => 'input'
                ]
            ]
        ],
        'images' => [
            'data' => [
                'params' => [
                    'marks' => [
                        'type' => 'image',
                        'resize' => ['resize', null, 56, false, true],
                        'hint' => false,
                    ],
                    'parts' => [
                        'type' => 'image',
                        'original_file' => true,
                    ]
                ]
            ]
        ],
        'auth' => [
            'register' => [
                'params' => [
                    'first_title'=>'input',
                    'first_text'=>'text',
                ]
            ],
            'register_right' => [
                'count'=>2,
                'params' => [
                    'title' => 'input',
                    'text' => 'text',
                ]
            ]
        ],
        'settings' => [
            'minimum' => [
                'params' => [
                    'shop' => [
                        'type' => 'number',
                        'min' => 0,
                        'max' => 1000000,
                    ],
                    'delivery' => [
                        'type' => 'number',
                        'min' => 0,
                        'max' => 1000000,
                    ],
                ],
            ],
        ],
        'texts' => [
            'data' => [
                'params' => [
                    'pickup' => 'text',
                    'delivery' => 'text',
                    'bank_text' => 'text',
                ]
            ]
        ]
    ];
}
