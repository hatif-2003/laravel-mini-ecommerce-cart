<div>
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->



    <div class="relative w-full max-w-7xl mx-auto">
        <!-- Carousel Container -->
        <div class="carousel-container">
            <div class="carousel flex">
                <!-- Slide 1 -->
                <div class="carousel-item min-w-full">
                    <img src="{{ asset('storage/banner/banner1.jpg') }}" alt="Banner 1" class="w-full h-96 object-cover">
                  
                </div>
                <!-- Add more slides as needed -->
                <!-- Example Slide 2 -->
                <div class="carousel-item min-w-full">
                    <img src="{{ asset('storage/banner/banner2.jpg') }}" alt="Banner 2"
                        class="w-full h-96 object-cover">
                   
                </div>
                 <div class="carousel-item min-w-full">
                    <img src="{{ asset('storage/banner/banner3.jpg') }}" alt="Banner 2"
                        class="w-full h-96 object-cover">
                   
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <button id="prevBtn"
            class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-white bg-opacity-50 p-2 rounded-full hover:bg-opacity-75 focus:outline-none">
            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button id="nextBtn"
            class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-white bg-opacity-50 p-2 rounded-full hover:bg-opacity-75 focus:outline-none">
            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <!-- Indicators -->
        <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2">
            <span class="indicator w-3 h-3 bg-white bg-opacity-50 rounded-full cursor-pointer" data-slide="0"></span>
            <span class="indicator w-3 h-3 bg-white bg-opacity-50 rounded-full cursor-pointer" data-slide="1"></span>
            <!-- Add more indicators if more slides are added -->
        </div>
    </div>

    <script>
        const carousel = document.querySelector('.carousel');
        const items = document.querySelectorAll('.carousel-item');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const indicators = document.querySelectorAll('.indicator');
        let currentIndex = 0;

        function updateCarousel() {
            carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
            indicators.forEach((indicator, index) => {
                indicator.classList.toggle('bg-opacity-100', index === currentIndex);
                indicator.classList.toggle('bg-opacity-50', index !== currentIndex);
            });
        }

        prevBtn.addEventListener('click', () => {
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : items.length - 1;
            updateCarousel();
        });

        nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex < items.length - 1) ? currentIndex + 1 : 0;
            updateCarousel();
        });

        indicators.forEach(indicator => {
            indicator.addEventListener('click', () => {
                currentIndex = parseInt(indicator.dataset.slide);
                updateCarousel();
            });
        });

        // Auto-slide every 5 seconds
        setInterval(() => {
            currentIndex = (currentIndex < items.length - 1) ? currentIndex + 1 : 0;
            updateCarousel();
        }, 5000);

        // Initialize carousel
        updateCarousel();
    </script>

</div>
