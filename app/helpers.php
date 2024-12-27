<?php

if (!function_exists('getAllTechCategories')) {
    function getAllTechCategories(): array
    {
        // Array of technologies grouped by category
        $technologies = [
            'Frontend' => [
                'React' => 'React',
                'Vue.js' => 'Vue.js',
                'Angular' => 'Angular',
                'Svelte' => 'Svelte',
                'Bootstrap' => 'Bootstrap',
                'Tailwind CSS' => 'Tailwind CSS',
                'jQuery' => 'jQuery',
                'Alpine.js' => 'Alpine.js',
                'HTML' => 'HTML',
                'CSS' => 'CSS',
                'Sass' => 'Sass',
                'LESS' => 'LESS',
                'JavaScript' => 'JavaScript',
                'TypeScript' => 'TypeScript',
            ],

            'Backend' => [
                'PHP' => 'PHP',
                'Python' => 'Python',
                'Laravel' => 'Laravel',
                'Symfony' => 'Symfony',
                'CodeIgniter' => 'CodeIgniter',
                'CakePHP' => 'CakePHP',
                'Yii' => 'Yii',
                'Zend Framework' => 'Zend Framework',
                'Slim' => 'Slim',
                'Node.js' => 'Node.js',
                'Express.js' => 'Express.js',
                'Django' => 'Django',
                'Flask' => 'Flask',
                'ASP.NET' => 'ASP.NET',
                'Ruby on Rails' => 'Ruby on Rails',
                'Spring Boot' => 'Spring Boot',
                'Hibernate' => 'Hibernate',
                'MySQL' => 'MySQL',
                'PostgreSQL' => 'PostgreSQL',
                'MongoDB' => 'MongoDB',
                'SQLite' => 'SQLite',
                'Redis' => 'Redis',
                'Firebase' => 'Firebase',
                'Oracle' => 'Oracle',
                'Microsoft SQL Server' => 'Microsoft SQL Server',
                'MariaDB' => 'MariaDB',
                'GraphQL' => 'GraphQL',
                'REST API' => 'REST API',
                'SOAP' => 'SOAP',
                'OAuth' => 'OAuth',
                'JWT' => 'JWT',
            ],

            'Tooling' => [
                'Docker' => 'Docker',
                'Kubernetes' => 'Kubernetes',
                'AWS' => 'AWS',
                'Google Cloud' => 'Google Cloud',
                'Azure' => 'Azure',
                'Heroku' => 'Heroku',
                'DigitalOcean' => 'DigitalOcean',
                'Linux' => 'Linux',
                'Apache' => 'Apache',
                'Nginx' => 'Nginx',
                'Git' => 'Git',
                'GitHub' => 'GitHub',
                'GitLab' => 'GitLab',
                'Bitbucket' => 'Bitbucket',
                'Composer' => 'Composer',
                'npm' => 'npm',
                'Yarn' => 'Yarn',
                'Webpack' => 'Webpack',
                'Gulp' => 'Gulp',
                'Grunt' => 'Grunt',
                'Babel' => 'Babel',
            ]
        ];

        return $technologies;
    }
}
