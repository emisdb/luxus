@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
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
    <script>
        var toggler = document.getElementsByClassName("caret");
        var i;

        for (i = 0; i < toggler.length; i++) {
            toggler[i].addEventListener("click", function() {
                this.parentElement.querySelector(".nested").classList.toggle("active");
                this.classList.toggle("caret-down");
            });
        }
    </script>

@endsection
