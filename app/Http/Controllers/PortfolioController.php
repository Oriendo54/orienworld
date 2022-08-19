<?php

namespace app\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PortfolioCartes;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PortfolioController extends Controller {
    public function portfolio() {
        $cards_game = PortfolioCartes::where('tag', 'game')->get();
        $cards_pro = PortfolioCartes::where('tag', 'pro')->get();
        $cards_autre = PortfolioCartes::where('tag', 'autre')->get();

        return view('portfolio', compact('cards_game', 'cards_pro', 'cards_autre'));
    }

    public function tictactoe() {
        return view('games.tictactoe');
    }

    public function memory() {
        // return $this->wip('portfolio');
        return view('games.memory');
    }

    public function pong() {
        return view('games.pong');
    }

    public function ponyOnFire() {
        return view('projects.pof');
    }

    public function snake() {
        // return $this->wip('portfolio');
        return view('games.snake');
    }

    public function skigame() {
        return $this->wip('portfolio');
    }

    public function cik() {
        return $this->wip('portfolio');
    }

    public function repertoire() {
        return $this->wip('portfolio');
    }

    public function agenda() {
        return $this->wip('portfolio');
    }

    public function shopping() {
        return $this->wip('portfolio');
    }

    public function todolist() {
        return view('projects.todo_list');
    }

}
