<x-member title="David's Page" jsResources="alpine">
    <nav class="flex flex-wrap items-center justify-between sticky top-13 bg-white px-6 py-3 sm:py-5" x-data="{ open: false }">
        <h1 class="text-[1rem] font-heading inline-flex items-center gap-2 text-spider-dark">
            David Datu Sarmiento | Biography
        </h1>

        <button @click="open = !open" class="sm:hidden text-2xl text-spider-primary">
            &#9776;
        </button>

        <div
            :class="open ? 'flex' : 'hidden'"
            class="basis-full sm:basis-auto flex-col sm:flex sm:flex-row gap-3 sm:gap-6 text-sm sm:text-base mt-3 sm:mt-0"
        >
            <a href="#biodata" class="hover:text-spider-primary">Biodata</a>
            <a href="#myStory" class="hover:text-spider-primary">My Story</a>
            <a href="#awards" class="hover:text-spider-primary">Awards</a>
            <a href="#social-media" class="hover:text-spider-primary">Social Media</a>
        </div>
    </nav>


    <!-- Biodata Section -->
    <section id="biodata" class="grid sm:grid-cols-2 gap-10 py-10 max-w-6xl mx-auto px-5">
        <div class="flex justify-center items-center">
            <img src="{{ asset('images/david/MyPhoto.png') }}" alt="MyPhoto" class="rounded-2xl shadow-soft w-80 sm:w-full">
        </div>
        <div class="flex flex-wrap gap-4">
            @foreach([
                ['label'=>'Age','value'=>'21'],
                ['label'=>'Birthday','value'=>'September 25, 2003'],
                ['label'=>'Gender','value'=>'Male'],
                ['label'=>'Nationality','value'=>'Filipino'],
                ['label'=>'Ethnicity','value'=>'Ilocano'],
                ['label'=>'Civil status','value'=>'Taken'],
                ['label'=>'Residing Address','value'=>'Magsaysay, Tagudin Ilocos Sur'],
                ['label'=>'Birth place','value'=>'Bungol Balaoan La Union'],
            ] as $info)
            <div class="flex flex-col gap-1 bg-spider-secondary border-l-4 border-spider-primary rounded-xl p-4 shadow-soft w-[45%]">
                <p class="text-sm text-spider-accent">{{ $info['label'] }}</p>
                <h1 class="text-base font-heading text-spider-dark">{{ $info['value'] }}</h1>
            </div>
            @endforeach
        </div>
    </section>

    <!-- My Story -->
    <section id="myStory" class="py-10 bg-spider-soft">
        <h1 class="text-2xl sm:text-3xl font-heading text-spider-dark text-center mb-8">My Story</h1>
        <div class="grid sm:grid-cols-3 gap-8 max-w-6xl mx-auto px-5">
            @foreach([
                ['title'=>'My childhood','img'=>'childhood.jpg','text'=>'I grew up in a humble home with three siblings, a young mother, and an older father. Early years guided by strict but loving guidance of my Lola...'],
                ['title'=>'My teenage years','img'=>'teenage_years.jpg','text'=>'My teenage years were a time of discovery, growth, and reflection. I explored friendships, academics, and started a small business...'],
                ['title'=>'My early adulthood','img'=>'early_adulthood.jpg','text'=>'As I entered adulthood, I became more self-aware, pursued IT studies, and embraced responsibilities. My spiritual journey and personal growth continued...'],
            ] as $story)
            <div class="flex flex-col gap-4 bg-spider-secondary rounded-2xl shadow-soft p-5">
                <img src="{{ asset('images/david/' . $story['img']) }}" alt="{{ $story['title'] }}" class="rounded-xl w-full h-48 object-cover shadow-soft">
                <h2 class="text-lg font-heading text-spider-primary">{{ $story['title'] }}</h2>
                <p class="text-sm text-spider-accent leading-relaxed text-justify">{{ $story['text'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Awards -->
    <section id="awards" class="py-10 max-w-6xl mx-auto px-5">
        <h1 class="text-2xl sm:text-3xl font-heading text-spider-dark text-center mb-8">Awards</h1>
        <div class="flex flex-wrap justify-center gap-10">
            @foreach([
                ['img'=>'sas.jpg','title'=>'High School (Grade 7–10)','desc'=>['Consistently awarded Outstanding Student every year.','Member of the school\'s marching band']],
                ['img'=>'airtop.jpg','title'=>'Senior High School','desc'=>['Grade 11 – Awarded Highest Honors.','Grade 12 – Graduated With Honors.','Youth mentor teaching basic IT to kids.']],
                ['img'=>'ispsc.png','title'=>'College','desc'=>['Achieved Dean’s Lister status in 2nd year']],
            ] as $award)
            <div class="flex flex-col items-center bg-spider-secondary p-5 rounded-2xl shadow-soft w-72">
                <img src="{{ asset('images/david/' . $award['img']) }}" alt="{{ $award['title'] }}" class="w-20 h-20 rounded-full mb-3 shadow-soft">
                <h2 class="text-lg font-heading text-spider-primary text-center">{{ $award['title'] }}</h2>
                @foreach($award['desc'] as $desc)
                <p class="text-sm italic text-spider-accent text-center">{{ $desc }}</p>
                @endforeach
            </div>
            @endforeach
        </div>
    </section>

    <!-- Social Media -->
    <section id="social-media" class="py-10 bg-spider-soft">
        <h2 class="text-xl sm:text-2xl font-heading text-spider-dark text-center mb-6">Follow me on social media!</h2>
        <div class="flex justify-center gap-6">
            <a href="https://fb.com/ddxsarmiento" class="hover:scale-105 transition">
                <img src="{{ asset('images/david/socmed/fb.png') }}" alt="Facebook" class="w-12 h-12 rounded-full shadow-soft">
            </a>
            <a href="https://tiktok.com/@_daviddatu" class="hover:scale-105 transition">
                <img src="{{ asset('images/david/socmed/tiktok.png') }}" alt="TikTok" class="w-12 h-12 rounded-full shadow-soft">
            </a>
            <a href="https://www.instagram.com/daviddatu_" class="hover:scale-105 transition">
                <img src="{{ asset('images/david/socmed/instagram.png') }}" alt="Instagram" class="w-12 h-12 rounded-full shadow-soft">
            </a>
        </div>
    </section>
</x-member>