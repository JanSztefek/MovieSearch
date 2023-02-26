<?php

namespace App\Http\Livewire\Components;

use App\Models\SearchKey;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Search extends Component
{
    public $searchField, $results = [], $resultsPerPage = 10, $page = 1;
    public $hostUrl, $apiKey;

    //https://api.themoviedb.org/3/search/movie?api_key=82e6d4abfbf816511a7aee8afe53f986&query=Jack+Reacher

    public function render()
    {
        return view('livewire.components.search');
    }


    // method that is called on first load component
    public function mount(){

        $this->hostUrl = config('themoviedb.host');
        $this->apiKey = config('themoviedb.apiKey');

        $this->callApi();
    }

    public function callApi(){
        if(!empty($this->searchField)){
            $url = $this->buildUrl();
            
            $this->results = Http::get($url)->json();

            if(!empty($this->results['results'])){
                $this->storageSearchKey();
            }
            
        }else{
            $this->results = '';
        }
    }

    public function buildUrl(){
        $searchKeys = str_replace(" ", "+", rtrim($this->searchField));
        $url = 'https://'.$this->hostUrl.'/3/search/movie?api_key='.$this->apiKey.'&query='.$searchKeys.'&language=cs&page='.$this->page;

        return $url;
    }

    public function prevPage(){
        if($this->page > 1){
            $this->page -= 1;
            $this->callApi();
        }
    }
    public function nextPage(){
        if($this->page < $this->results['total_pages']){
            $this->page += 1;
            $this->callApi();
        }
    }

    public function storageSearchKey(){
        $searchKeysToArray = explode(' ', $this->searchField); // only words
        $searchKeysToArray = [$this->searchField]; // full submited search value


        $user = new SearchKey();

        foreach ($searchKeysToArray as $key){
            $user->updateOrInsert(
                ['key' => $key],
                ['count' => $user->where('key', $key)->value('count') + 1]
            );
            /*
            $record = $user->where('key', $key)->first();

            if ($record) {
                $record->increment('count');
            } else {
                $user->create([
                    'key' => $key,
                    'count' => 1
                ]);
            }
            */
        }
        
    }

}
