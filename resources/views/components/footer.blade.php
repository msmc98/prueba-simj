<footer class="bg-light text-center text-lg-start"
    @if (Auth::user()) style="position: absolute; bot: 0; width: 84.82946%; margin-left: 15vw;" @else style="position: absolute; bot: 0; width: 100%;" @endif>
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        ©
        @php
            echo date('Y');
        @endphp
        Copyright:
        <a class="text-dark" href="https://www.linkedin.com/in/manuel-s-mu%C3%B1oz-cobos-63b1781b7/">Manuel Muñoz</a>
    </div>
    <!-- Copyright -->
</footer>
