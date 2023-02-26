<div class="search">
    {{-- The best athlete wants his opponent at his best. --}}
    
    <div class="search__field">
        <select wire:model="resultsPerPage" wire:change="callApi" id="" style="display:none;">
            <option value="10">10</option>
            <option value="230">30</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <form wire:submit.prevent="callApi" class="row gap-10">
            <input class="search__field-search" type="text" wire:model="searchField" wire:keydown.enter="callApi" placeholder="Název filmu..">
            <button type="submit">Vyhledat</button>
        </form>

        <div class="search__paginator">
            <button wire:click="prevPage"><</button>
            <button wire:click="nextPage">></button>
        </div>
    </div>

    <div class="search__result">
        @isset($results['results'])
            @forelse ($results['results'] as $item)
                <div class="search__item">
                    <div class="search__item-thumbcontainer">
                        @empty($item['backdrop_path'])
                            <img style="opacity:0;" src="" alt="{{$item['title']}}">
                            <img class="search__item-thumb" src="" alt="{{$item['title']}}">
                        @else
                            <img style="opacity:0;" src="https://image.tmdb.org/t/p/w220_and_h330_face{{$item['backdrop_path']}}" alt="{{$item['title']}}">
                            <img class="search__item-thumb" src="https://image.tmdb.org/t/p/w220_and_h330_face{{$item['backdrop_path']}}" alt="{{$item['title']}}">
                        @endempty
                        <p class="search__item-overview">{{$item['overview']}}</p>
                    </div>
                    
                    <div class="search__item-description">
                        <p class="search__item-name">{{$item['title']}}</p>
                        <div class="search__item-detail">
                        
                            <div class="row">
                                <div class="search__item-release">
                                    <p>{{$item['release_date']}}</p>
                                </div>
                                <div class="search__item-rating">
                                    <p>{{substr($item['vote_average'], 0, 3);}}<span>/</span>10</p>
                                    <img src="{{asset('/img/star.png')}}"  alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>Zadejte název filmu</p>
            @endforelse
        @endisset
    </div>


    <script>
        const settings = {
            "async": true,
            "crossDomain": true,
            "url": "https://unogs-unogs-v1.p.rapidapi.com/search/titles?order_by=date&type=movie",
            "method": "GET",
            "headers": {
                "X-RapidAPI-Key": "6ffe8e9031msha0e3430918f0764p13ed8cjsn857d8066745e",
                "X-RapidAPI-Host": "unogs-unogs-v1.p.rapidapi.com"
            }
        };

        $.ajax(settings).done(function (response) {
            console.log(response);
        });
    </script>
</div>
