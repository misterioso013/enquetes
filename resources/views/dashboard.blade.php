@inject('votes', 'App\Http\Controllers\PollController')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Enquetes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <table class="border-collapse table-auto w-full text-sm">
                        <thead>
                        <tr>
                            <th class="border-b pb-3 text-left">Título / Pergunta</th>
                            <th class="border-b pb-3">Início</th>
                            <th class="border-b pb-3">Fim</th>
                            <th class="border-b pb-3">Votos</th>
                            <th class="border-b pb-3">Detalhes</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-slate-800">
                        @forelse($polls as $poll)
                            <tr>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{$poll->title}}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{date("H:i:s d/m/Y",strtotime($poll->start))}}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{date("H:i:s d/m/Y",strtotime($poll->end))}}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{$votes::countVotes($poll->id)}}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400"><a href="{{route('poll.answer',$poll->id)}}">Ver/Votar</a></td>
                            </tr>
                            @empty
                            <tr>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400"><a href="{{route('poll')}}#create">Cique aqui para criar sua primeira enquete</a></td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
