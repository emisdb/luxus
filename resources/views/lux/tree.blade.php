@extends('lux.layout.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ __($header) }}</div>

                <div class="card-body">
                    <ul id="myUL">
                        <li><span class="caret">ROSA estandar</span>
                            <ul class="nested">
                                <li><span class="caret">ROSA estandar amarillo</span>
                                    <ul class="nested">
                                        <li>SUMMER HOUSE</li>
                                        <li>SUNSET X-PRESSION</li>
                                        <li>SWEET 4LOVE</li>
                                    </ul>
                                </li>
                                <li><span class="caret">ROSA estandar bicolor</span>
                                    <ul class="nested">
                                        <li>SUMMER HOUSE</li>
                                        <li>WHITE O’HARA</li>
                                        <li>SWEET 4LOVE</li>
                                    </ul>
                                </li>
                                <li><span class="caret">ROSA estandar blanco</span>
                                    <ul class="nested">
                                        <li>SUMMER HOUSE</li>
                                        <li>WILD SPIRIT</li>
                                        <li>WHITE O’HARA</li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><span class="caret">ROSA garden/садовая</span>
                            <ul class="nested">
                                <li><span class="caret">ROSA garden/садовая amarillo</span>
                                    <ul class="nested">
                                        <li>WHITE O’HARA</li>
                                        <li>SUNSET X-PRESSION</li>
                                        <li>SWEET 4LOVE</li>
                                    </ul>
                                </li>
                                <li><span class="caret">ROSA garden/садовая bicolor</span>
                                    <ul class="nested">
                                        <li>SUMMER HOUSE</li>
                                        <li>WHITE O’HARA</li>
                                        <li>WILD SPIRIT</li>
                                    </ul>
                                </li>
                                <li><span class="caret">ROSA garden/садовая blanco</span>
                                    <ul class="nested">
                                        <li>SUMMER HOUSE</li>
                                        <li>SUNSET X-PRESSION</li>
                                        <li>SWEET 4LOVE</li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><span class="caret">АЛЬСТРОМЕРИЯ/ALSTROMERIA</span>
                            <ul class="nested">
                                <li><span class="caret">АЛЬСТРОМЕРИЯ/ALSTROMERIA</span>
                                    <ul class="nested">
                                        <li>SUMMER HOUSE</li>
                                        <li>SUNSET X-PRESSION</li>
                                        <li>SWEET 4LOVE</li>
                                    </ul>
                                </li>
                                <li><span class="caret">АЛЬСТРОМЕРИЯ/ALSTROMERIA bicolor</span>
                                    <ul class="nested">
                                        <li>ALSTROMERIA GREEN PLANET</li>
                                        <li>ALSTROMERIA GREEN PLANET</li>
                                        <li>SWEET 4LOVE</li>
                                    </ul>
                                </li>
                                <li><span class="caret">АЛЬСТРОМЕРИЯ/ALSTROMERIA blanco</span>
                                    <ul class="nested">
                                        <li>ALSTROMERIA GREEN PLANET</li>
                                        <li>ALSTROMERIA GREEN PLANET</li>
                                        <li>ALSTROMERIA GREEN PLANET</li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <script>
        var toggler = document.getElementsByClassName("caret");
        var i;

        for (i = 0; i < toggler.length; i++) {
            toggler[i].addEventListener("click", function () {
                this.parentElement.querySelector(".nested").classList.toggle("active");
                this.classList.toggle("caret-down");
            });
        }
    </script>

@endsection
