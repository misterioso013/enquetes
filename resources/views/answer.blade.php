@inject('result', 'App\Http\Controllers\PollController')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Participe da votação |
            @if($votes > 1)
            <span class="ml-2 text-sm text-gray-600">{{ $votes }} Votos </span>
            @elseif($votes == 1)
                <span class="ml-2 text-sm text-gray-600">{{ $votes }} Voto </span>
            @else
                <span class="ml-2 text-sm text-gray-600">Ninguém votou </span>
            @endif
            |
            @if($open)
                <span class="ml-2 text-sm text-green-600">Votação aberta</span>
            @else
                @if(!$expired)
                <span class="ml-2 text-sm text-gray-600">Votação iniciará <strong>{{ date("H:i:s d/m/Y",strtotime($poll->start))  }}</strong></span>
                @else
                    <span class="ml-2 text-sm text-red-600">Votação encerrada</span>
                @endif
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <h2 class="text-xl">{{ $poll->title }}</h2>
                    <form action="{{route('add_answer')}}" method="POST">
                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                        <input type="hidden" value="{{ $poll->id }}" name="poll_id">
                        @csrf
                    <?php $i = 0 ?>
                    @foreach(json_decode($poll->answers) as $answer)

                        <div class="block mt-4">
                            <label for="answer-{{$i}}" class="inline-flex items-center">
                                <input id="answer-{{$i}}" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="answer" onclick="onlyOne(this)" value="{{$i}}">
                                <span class="ml-2 text-sm text-gray-600">{{ $answer }} </span> <span class="ml-2 text-sm text-gray-700"> - {{$result::answerCount($i, $poll->id)}}</span>
                            </label>
                        </div>
                            <?php $i = $i + 1; ?>
                    @endforeach
                        <div class="mt-1">
                            @if($open)
                                @if(!$voted)
                            <button class="px-4 py-2 font-semibold text-sm bg-gray-800 text-white mt-1 rounded-full shadow-sm" type="submit">Votar</button>
                                @else
                                    <span class="ml-2 text-sm text-indigo-600">Muito obrigado por participar!</span>
                                @endif
                            @else
                                <span class="ml-2 text-sm text-red-600">Não é possível participar dessa votação!</span>
                            @endif
                        </div>
                    </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <script>
        @if($voted)
        document.querySelector('#answer-{{$voted->answer}}').checked = true;
        document.querySelectorAll('input[type="checkbox"]').forEach((item) =>{
            item.setAttribute('disabled','');
        })

            @endif
        function onlyOne(checkbox) {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach((item) => {
                if (item !== checkbox) item.checked = false
            })
        }
    </script>
</x-app-layout>
