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
                    <h2 class="text-xl">Editar Enquete</h2>
                    <form action="{{route('edit_poll')}}" method="post">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <input type="hidden" name="user" id="user" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="poll_id" id="poll" value="{{ $poll->id }}">
                        <div>
                            <label class="block font-medium text-sm text-gray-700" for="title">
                                Título da Enquete
                            </label>

                            <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" value="{{ $poll->title }}" id="title" type="text" name="title" required="required">
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700" for="answer">
                                Respostas da enquete
                            </label>

                            <div id="answers">
                                <?php $i = 0 ?>
                                @foreach(json_decode($poll->answers) as $answer)
                                    <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" type="text" id="answer" placeholder="Nova Resposta" name="answer[{{ $i }}]" value="{{ $answer }}">
                                        <?php $i = $i + 1; ?>
                                    @endforeach
                            </div>

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
                            <button class="px-4 py-2 font-semibold text-sm bg-gray-800 text-white mt-1 rounded-full shadow-sm" id="send_answer"  type="submit">Editar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
