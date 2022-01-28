<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Database\Console\Migrations\ResetCommand;
use Illuminate\Http\Request;
use App\Models\Poll;
use  App\Models\Answer;
use Illuminate\Support\Facades\Auth;

class PollController extends Controller
{
    public function index(){

        $polls = Poll::where('user_id',Auth::user()->id)->get();
        return view('poll',['polls' => $polls]);
    }
    public function edit_view($id){

        $poll = Poll::where('id',$id)->first();

        if(!$this->ValidateDate($poll->start) or !$this->ValidateDate($poll->end)){
            return redirect()->route('poll');
        }elseif($poll->user_id != Auth::user()->id){
            return redirect()->route('poll');
        }

        return view('edit',['poll' => $poll]);
    }
    public function answer($id){
        $votes = Answer::where('poll_id', $id)->count();
        $voted = Answer::where('user_id', Auth::user()->id)->where('poll_id', $id)->first();
        $poll = Poll::where('id',$id)->first();

        $start = $poll->start;
        $end = $poll->end;

if(!$this->ValidateDate($start) and $this->ValidateDate($end)) {
    $open = true;
}else{
    $open = false;
}
if(!$this->ValidateDate($start) and !$this->ValidateDate($end)){
    $expired = true;
}else{
    $expired = false;
}
        return view('answer',[
            'poll' => $poll,
            'votes' => $votes,
            'open' => $open,
            'expired' => $expired,
            'voted' => $voted
        ]);
    }
    public function create(Request $request): \Illuminate\Http\RedirectResponse
    {

        $title = $request->input('title');
        $answers = json_encode($request->input('answer'));
        $start = date("Y-m-d H:i:s",strtotime($request->input('start')));
        $end = date("Y-m-d H:i:s",strtotime($request->input('end')));
        $user_id = $request->input('user');
        $poll = new Poll();
        $poll->create([
            'title' => $title,
            'answers' => $answers,
            'start' => $start,
            'end' => $end,
            'user_id' =>  $user_id
        ]);
        $request->session()->flash('success', "Votação criada para a pergunta: " . $title);
        return redirect()->route('poll');
    }
    public function edit(Request $request): \Illuminate\Http\RedirectResponse
    {

        $title = $request->input('title');
        $answers = json_encode($request->input('answer'));
        $start = date("Y-m-d H:i:s",strtotime($request->input('start')));
        $end = date("Y-m-d H:i:s",strtotime($request->input('end')));
        $user_id = $request->input('user');
        $poll = new Poll();
        $poll->where('id', $request->input('poll_id'))->update([
            'title' => $title,
            'answers' => $answers,
            'start' => $start,
            'end' => $end,
            'user_id' =>  $user_id
        ]);
        $request->session()->flash('success', "Votação editada com sucesso");
        return redirect()->route('poll');
    }
    public function delete($id) {
        $poll = Poll::where('id',$id)->first();

        if($poll->user_id != Auth::user()->id){
            return redirect()->route('poll');
        }
        Poll::destroy($id);
        return redirect()->route('poll');
    }
    public function vote(Request $request)
    {
        $answer_response = $request->input('answer');
        $user_id = Auth::user()->id;
        $poll_id = $request->input('poll_id');
        $answer = new Answer();
        $answer->create([
            'answer' => $answer_response,
            'user_id' => $user_id,
            'poll_id' => $poll_id
        ]);
        $request->session()->flash('success', "Voto adicionado com sucesso");
        return redirect()->route('poll.answer',$request->input('poll_id'));
    }
    public function ValidateDate($date): bool
    {
        $date = strtotime($date);
        $datetime = strtotime(date("Y-m-d H:i:s"));

        if($date - $datetime < 0) {
            return false;
        }else{
            return true;
        }
    }
    public static function answerCount($answer, $poll_id): string
    {
        $result = Answer::where('poll_id', $poll_id)->where('answer', $answer)->count();
        if($result == 1){
            $res = "Recebeu 1 voto";
        }elseif($result > 1){
            $res = "Recebeu $result votos";
        }else{
            $res = "Não teve votos";
        }
        return $res;
    }
    public static function countVotes($id) {
        return Answer::where('poll_id', $id)->count();
    }
}
