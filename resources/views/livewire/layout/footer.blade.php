<?php


?>

<footer class="bg-gray-800 text-white py-8">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <h5 class="text-lg font-semibold">Follow Us</h5>
                <div class="flex space-x-4 mt-2">
                    <a href="{{ config('site.socials.facebook') }}" target="_blank" class="hover:text-orange-500">
                        <x-fa-b-square-facebook class="w-6 h-6 fill-current" />
                    </a>
                    <a href="{{ config('site.socials.youtube') }}" target="_blank" class="hover:text-orange-500">
                        <x-fa-b-youtube class="w-7 h-7 fill-current" />
                    </a>
                    <a href="{{ config('site.socials.instagram') }}" target="_blank" class="hover:text-orange-500">
                        <x-fa-b-instagram class="w-6 h-6 fill-current" />
                    </a>
                    <a href="{{ config('site.socials.linkedin') }}" target="_blank" class="hover:text-orange-500">
                        <x-fa-b-linkedin class="w-6 h-6 fill-current" />
                    </a>
                    <a href="{{ config('site.socials.github') }}" target="_blank" class="hover:text-orange-500">
                        <x-fa-b-github class="w-6 h-6 fill-current" />
                    </a>
                </div>
            </div>
            <div class="text-center md:text-right">
                <p>&copy; {{ date('Y') }} - {{ config('app.name') }}. All rights reserved.</p>
                <p class="text-sm text-gray-500">Powered by <a href="https://cyberdudenetworks.com">CyberDude Networks
                                                                                                    Pvt. Ltd.</a></p>
            </div>
        </div>
    </div>
</footer>
