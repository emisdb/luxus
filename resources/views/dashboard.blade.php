<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul id="myUL">
                        <li><span class="caret">Beverages</span>
                            <ul class="nested">
                                <li>Water</li>
                                <li>Coffee</li>
                                <li><span class="caret">Tea</span>
                                    <ul class="nested">
                                        <li>Black Tea</li>
                                        <li>White Tea</li>
                                        <li><span class="caret">Green Tea</span>
                                            <ul class="nested">
                                                <li>Sencha</li>
                                                <li>Gyokuro</li>
                                                <li>Matcha</li>
                                                <li>Pi Lo Chun</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
