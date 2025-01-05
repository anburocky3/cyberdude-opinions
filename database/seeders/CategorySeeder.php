<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'title' => 'Web Development',
            'slug' => 'web-development',
            'description' => 'Web development is the work involved in developing a website for the Internet (World Wide Web) or an intranet (a private network).',
        ]);

        Category::create([
            'title' => 'Mobile Development',
            'slug' => 'mobile-development',
            'description' => 'Mobile app development is the act or process by which a mobile app is developed for mobile devices, such as personal digital assistants, enterprise digital assistants, or mobile phones.',
        ]);

        Category::create([
            'title' => 'Data Science',
            'slug' => 'data-science',
            'description' => 'Data science is an inter-disciplinary field that uses scientific methods, processes, algorithms and systems to extract knowledge and insights from structured and unstructured data.',
        ]);

        Category::create([
            'title' => 'Artificial Intelligence',
            'slug' => 'artificial-intelligence',
            'description' => 'Artificial intelligence (AI) is intelligence demonstrated by machines, unlike the natural intelligence displayed by humans and animals, which involves consciousness and emotionality.',
        ]);

        Category::create([
            'title' => 'Cybersecurity',
            'slug' => 'cybersecurity',
            'description' => 'Cybersecurity is the practice of protecting systems, networks, and programs from digital attacks. These attacks are usually aimed at accessing, changing, or destroying sensitive information; extorting money from users; or interrupting normal business processes.',
        ]);

        Category::create([
            'title' => 'Cloud Computing',
            'slug' => 'cloud-computing',
            'description' => 'Cloud computing is the on-demand availability of computer system resources, especially data storage (cloud storage) and computing power, without direct active management by the user.',
        ]);

        Category::create([
            'title' => 'DevOps',
            'slug' => 'devops',
            'description' => 'DevOps is a set of practices that combines software development (Dev) and IT operations (Ops). It aims to shorten the systems development life cycle and provide continuous delivery with high software quality.',
        ]);

        Category::create([
            'title' => 'Blockchain',
            'slug' => 'blockchain',
            'description' => 'A blockchain is a growing list of records, called blocks, that are linked using cryptography. Each block contains a cryptographic hash of the previous block, a timestamp, and transaction data.',
        ]);

        Category::create([
            'title' => 'Internet of Things',
            'slug' => 'internet-of-things',
            'description' => 'The Internet of Things (IoT) describes the network of physical objects—“things”—that are embedded with sensors, software, and other technologies for the purpose of connecting and exchanging data with other devices and systems over the Internet.',
        ]);

        Category::create([
            'title' => 'Big Data',
            'slug' => 'big-data',
            'description' => 'Big data is a field that treats ways to analyze, systematically extract information from, or otherwise deal with data sets that are too large or complex to be dealt with by traditional data-processing application software.',
        ]);

        Category::create([
            'title' => 'Machine Learning',
            'slug' => 'machine-learning',
            'description' => 'Machine learning is a method of data analysis that automates analytical model building. It is a branch of artificial intelligence based on the idea that systems can learn from data, identify patterns and make decisions with minimal human intervention.',
        ]);

        Category::create([
            'title' => 'Programming',
            'slug' => 'programming',
            'description' => 'Computer programming is the process of designing and building an executable computer program to accomplish a specific computing result or to perform a specific task.',
        ]);

        Category::create([
            'title' => 'Software Development',
            'slug' => 'software-development',
            'description' => 'Software development is the process of conceiving, specifying, designing, programming, documenting, testing, and bug fixing involved in creating and maintaining applications, frameworks, or other software components.',
        ]);

        Category::create([
            'title' => 'Networking',
            'slug' => 'networking',
            'description' => 'Networking is the practice of connecting computers and other devices so that they can communicate with each other.',
        ]);

        Category::create([
            'title' => 'Game Development',
            'slug' => 'game-development',
            'description' => 'Game development is the process of creating video games and games for computers, consoles, and mobile devices.',
        ]);

        Category::create([
            'title' => 'Digital Marketing',
            'slug' => 'digital-marketing',
            'description' => 'Digital marketing is the component of marketing that utilizes internet and online based digital technologies such as desktop computers, mobile phones and other digital media and platforms to promote products and services.',
        ]);

        Category::create([
            'title' => 'UI/UX Design',
            'slug' => 'ui-ux-design',
            'description' => 'User interface (UI) and user experience (UX) design are two of the most important aspects of web design. A good UI/UX design will make your website easier to use and more engaging for your audience.',
        ]);

        Category::create([
            'title' => 'Project Management',
            'slug' => 'project-management',
            'description' => 'Project management is the process of leading the work of a team to achieve goals and meet success criteria at a specified time. The primary challenge of project management is to achieve all of the project goals within the given constraints.',
        ]);

        // create more categories on coding like PHP, Laravel, Python, Django, JavaScript, React, Vue, Angular, etc.

    }
}
