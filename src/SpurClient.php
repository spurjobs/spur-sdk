<?php

namespace Spur;

class SpurClient extends SpurClientBase
{
    // Jobs

    public function createJob(int $place_id, array $params)
    {
        return $this->post("places/{$place_id}/jobs", $params);
    }

    // Places

    public function createPlace(array $params)
    {
        return $this->post('places/register', $params);
    }

    // Billing

    public function addPaymentMethod(int $place_id, array $params)
    {
        return $this->post("/places/{$place_id}/billing/payment-methods/credit", $params);
    }

    // Positions

    public function getPositions(array $params = [])
    {
        return $this->get("positions", $params);
    }

    // Punches

    public function getPunches(int $shift_id)
    {
        return $this->get("shifts/{$shift_id}/punches");
    }

    // Shifts

    public function createShifts(int $team_id, array $params)
    {
        return $this->post("jobs/{$team_id}/shifts", $params);
    }

    // Workers

    public function getWorkers(int $team_id, array $params)
    {
        return $this->get("jobs/{$team_id}/workers", $params);
    }
}
