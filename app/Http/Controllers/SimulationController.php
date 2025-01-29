<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prize;

class SimulationController extends Controller
{
    public function index()
    {
        $prizes = Prize::all();  // Get all available prizes
        return view('simulate', compact('prizes'));
    }

    public function runSimulation(Request $request)
    {
        // Get the number of prizes to simulate from the request
        $numPrizes = $request->input('num_prizes');

        // Fetch all available prizes (now based on probabilities)
        $prizes = Prize::all();

        // Check if the number of prizes to simulate is positive
        if ($numPrizes <= 0) {
            return redirect()->route('simulate')->with('error', 'Number of prizes to simulate must be greater than 0.');
        }

        // Simulate the prize distribution based on probabilities
        $this->simulateAllPrizes($prizes, $numPrizes);

        // Provide feedback message for the simulation
        return redirect()->route('simulate')->with('message', "{$numPrizes} prizes have been awarded.");
    }

    // Method to simulate awarding prizes based on their probabilities
    private function simulateAllPrizes($prizes, $numPrizes)
    {
        foreach ($prizes as $prize) {
            // Calculate how many times this prize should be awarded based on its probability
            $awardedCount = (int)(($prize->probability / 100) * $numPrizes);

            // Update the 'awarded' count for the prize in the database
            $prize->increment('awarded', $awardedCount);
        }
    }

    // Store a new prize (Ensure probability does not exceed 100%)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'probability' => 'required|numeric|min:0|max:100',
        ]);

        // Check if the total probability will exceed 100%
        $totalProbability = Prize::sum('probability') + $request->probability;
        if ($totalProbability > 100) {
            return redirect()->route('simulate')->with('error', 'Total probability cannot exceed 100%.');
        }

        Prize::create($request->all());

        return redirect()->route('simulate')->with('message', 'Prize added successfully!');
    }

    // Edit an existing prize
    public function edit($id)
    {
        $prize = Prize::findOrFail($id);
        return view('edit', compact('prize'));
    }

    // Update an existing prize (Ensure probability does not exceed 100%)
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'probability' => 'required|numeric|min:0|max:100',
        ]);

        $prize = Prize::findOrFail($id);

        // Check if updating this prize will exceed 100% total probability
        $totalProbability = Prize::where('id', '!=', $id)->sum('probability') + $request->probability;
        if ($totalProbability > 100) {
            return redirect()->route('simulate')->with('error', 'Total probability cannot exceed 100%.');
        }

        $prize->update($request->all());

        return redirect()->route('simulate')->with('message', 'Prize updated successfully!');
    }

    // Delete a prize
    public function destroy($id)
    {
        $prize = Prize::findOrFail($id);
        $prize->delete();

        return redirect()->route('simulate')->with('message', 'Prize deleted successfully!');
    }
}
