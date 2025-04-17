<?php
return [
    'function' => [
        [
            'name' => 'Dashboard',
            'icon' => '<svg class="pc-icon"><use xlink:href="#custom-home"></use></svg>',
            'route' => route('admin.dashboard'),
            'module' => []
        ],
        [
            'name' => 'User Management',
            'icon' => '<svg class="pc-icon"><use xlink:href="#custom-user"></use></svg>',
            'route' => ['user'],
            'module' => [
                [
                    'name' => 'Users List',
                    'path' => route('admin.user.index')
                ],
                [
                    'name' => 'Add New User',
                    'path' => route('admin.user.create')
                ],
            ]
        ],
        [
            'name' => 'Category Management',
            'icon' => '<svg class="pc-icon"> <use xlink:href="#custom-element-plus"></use> </svg>',
            'route' => ['category'],
            'module' => [
                [
                    'name' => 'Categories List',
                    'path' => route('admin.category.index')
                ],
                [
                    'name' => 'Create Category',
                    'path' => route('admin.category.create')
                ]
            ]
        ],
        [
            'name' => 'Story Management',
            'icon' => '<svg class="pc-icon"> <use xlink:href="#custom-element-plus"></use> </svg>',
            'route' => ['category'],
            'module' => [
                [
                    'name' => 'Stories List',
                    'path' => route('admin.story.index')
                ],
                [
                    'name' => 'Create Story',
                    'path' => route('admin.story.create')
                ]

            ]
        ],
        [
            'name' => 'System Management',
            'icon' => '<svg class="pc-icon"> <use xlink:href="#custom-setting-2"></use> </svg>',
            'route' => route('admin.setting.index'),
            'module' => []
        ]
    ]
];
