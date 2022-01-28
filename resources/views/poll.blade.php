@inject('votes', 'App\Http\Controllers\PollController')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Minhas Enquetes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl">Suas enquetes</h2>

                    <table class="border-collapse table-auto w-full text-sm">
                        <thead>
                        <tr>
                            <th class="border-b pb-3 text-center">Título / Pergunta</th>
                            <th class="border-b pb-3">Início</th>
                            <th class="border-b pb-3">Fim</th>
                            <th class="border-b pb-3">Votos</th>
                            <th class="border-b pb-3">Ver</th>
                            <th class="border-b pb-3">Editar</th>
                            <th class="border-b pb-3">Excluir</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-slate-800">
                        @foreach($polls as $poll)
                            <tr>
                                <td class="border border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400 text-left">{{$poll->title}}</td>
                                <td class="border border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400 text-center">{{$poll->start}}</td>
                                <td class="border border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400 text-center">{{$poll->end}}</td>
                                <td class="border border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400 text-center">{{$votes::countVotes($poll->id)}}</td>
                                <td class="border border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400 text-center"><a href="{{route('poll.answer',$poll->id)}}">Ver</a></td>
                                <td class="border border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400 text-center"><a href="{{route('edit.poll',$poll->id)}}">Editar</a></td>
                                <td class="border border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400 text-center"><a href="{{route('delete.poll',$poll->id)}}" style="color:red;">Excluir</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12" id="create">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl">Criar Enquete</h2>
                    <form action="{{route('add_poll')}}" method="post">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <input type="hidden" name="user" id="user" value="{{ Auth::user()->id }}">
                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="title">
                                    Título da Enquete
                                </label>

                                <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="title" type="text" name="title" required="required">
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="answer">
                                    Respostas da enquete
                                </label>

                                <div id="answers">

                                </div>

                                <div id='number_min'>
                                    <p class="text-sm" style="color:rgb(239 68 68);">Você precisa adicionar no mínimo 3 respostas.</p>
                                </div>
                            </div>
                        <div class="mt-1">
                                <button class="px-4 py-2 font-semibold text-sm bg-gray-800 text-white mt-1 rounded-full shadow-sm" id="add_answer"  type="button">Adicionar outra</button>
                        </div>
                                <div class="mt-2">
                                    <label class="block font-medium text-sm text-gray-700" for="start">
                                        Quando deve iniciar?
                                    </label>

                                    <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="start" type="datetime-local" name="start" required="required">
                                </div>
                                <div class="mt-2">
                                    <label class="block font-medium text-sm text-gray-700" for="end">
                                        Quando deve terminar?
                                    </label>

                                    <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="end" type="datetime-local" name="end" required="required">
                                </div>

                        <div class="mt-3">
                            <button class="px-4 py-2 font-semibold text-sm bg-gray-800 text-white mt-1 rounded-full shadow-sm" id="send_answer"  type="submit" disabled>Criar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function setAttributes(el, attrs) {
            for(const key in attrs) {
                el.setAttribute(key, attrs[key]);
            }
        }

        const create_html = document.createElement('input');
        window.onload = function () {
            document.querySelector('#answers').appendChild(create_html);
            const input = document.querySelector('#answers').querySelector('input');
            input.classList.add('rounded-md', 'shadow-sm', 'border-gray-300', 'focus:border-indigo-300', 'focus:ring', 'focus:ring-indigo-200', 'focus:ring-opacity-50', 'block', 'mt-1', 'w-full');
            setAttributes(input, {"type": "text", "id": "answer", "required" : "required", "placeholder" : "Nova Resposta", "name" : "answer[0]"});
        }
        const btn_add_answers  = document.querySelector('#add_answer')
        let num_click = 0;
        btn_add_answers.addEventListener('click', function () {
            num_click++;
            // Adicionar novo input
            document.querySelector('#answers').insertAdjacentHTML('beforeend',`<input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" type="text" id="answer" placeholder="Nova Resposta" name="answer[${num_click}]">`);

            let num_answers = document.querySelector('#answers').querySelectorAll('input');
            if(num_answers.length >= 3) {
                document.querySelector('#number_min').style = 'display:none;';
                document.querySelector('#send_answer').removeAttribute('disabled');
            }
            for(let i = 0; num_answers.length > i; i++){
               let input = num_answers[i];

            }
        })
    </script>
</x-app-layout>
