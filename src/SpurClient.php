<?php

namespace Spur;

class SpurClient extends SpurClientBase
{
    // Additonal Wadges

    public function createWageAdjustment($place_id, array $params)
    {
        return $this->post("places/{$place_id}/worker-adjustments", $params);
    }

    public function deleteWageAdjustment($adjustment_id)
    {
        return $this->delete("worker-adjustments/${adjustment_id}");
    }

    // Auth

    public function registerUserWithApi(array $params)
    {
        return $this->post('auth/register', $params);
    }

    // Billing

    public function addPaymentMethod(int $place_id, array $params)
    {
        return $this->post("places/{$place_id}/billing/payment-methods/credit", $params);
    }

    // Credentials

    public function createJobCredential(int $job_id, array $params = [])
    {
        return $this->post("jobs/{$job_id}/credentials", $params);
    }

    public function deleteJobCredential(int $job_id, int $credential_id)
    {
        return $this->delete("jobs/{$job_id}/credentials/{$credential_id}");
    }

    public function getCredentials(array $params = [])
    {
        return $this->get('credentials', $params);
    }

    public function getJobCredentials(int $job_id, array $params = [])
    {
        return $this->get("jobs/{$job_id}/credentials", $params);
    }

    public function getWorkerCredentials(int $worker_id, array $params = [])
    {
        return $this->get("workers/{$worker_id}/credentials", $params);
    }

    public function getWorkerCredential(int $worker_credential_id)
    {
        return $this->get("user-credentials/{$worker_credential_id}");
    }

    public function getWorkerOnboardingStatus(int $user_id)
    {
        return $this->post('worker-signup-progress', ['user_id' => $user_id]);
    }

    public function getWorkersStagesProgress($users)
    {
        return $this->post('worker-stages-progress', ['users' => $users]);
    }

    // Disputes

    public function getDispute(int $dispute_id)
    {
        return $this->get("disputes/{$dispute_id}");
    }

    public function createDispute(int $shift_id, array $params)
    {
        return $this->post("shifts/{$shift_id}/disputes", $params);
    }

    public function resolveDispute(int $dispute_id)
    {
        return $this->post("disputes/{$dispute_id}/resolve");
    }

    // Teams

    public function createTeam(int $place_id, array $params)
    {
        return $this->post("places/{$place_id}/teams", $params);
    }

    public function updateTeam(int $team_id, array $params)
    {
        return $this->put("teams/{$team_id}", $params);
    }

    // Jobs

    // @deprecated //
    public function createJob(int $place_id, array $params)
    {
        return $this->post("places/{$place_id}/jobs", $params);
    }

    public function getJobWorkers(int $team_id, array $params)
    {
        return $this->get("jobs/{$team_id}/workers", $params);
    }

    public function getAvailableWorkers(int $team_id, array $params)
    {
        return $this->post("jobs/{$team_id}/available-workers", $params);
    }

    public function updateJob(int $job_id, array $params)
    {
        return $this->put("jobs/{$job_id}", $params);
    }

    public function getJobPhotos(int $job_id)
    {
        return $this->get("jobs/{$job_id}/photos");
    }

    public function addJobPhoto(int $job_id, $file, $filename, array $params = [])
    {
        $multipart[] = [
            'name' => 'file',
            'contents' => fopen($file, 'r'),
            'filename' => $filename,
        ];

        foreach ($params as $name => $value) {
            $multipart[] = [
                'name' => $name,
                'contents' => $value,
            ];
        }

        return $this->send('POST', "jobs/{$job_id}/photos", ['multipart' => $multipart]);
    }

    public function deleteJobPhoto(int $job_id, int $photo_id)
    {
        return $this->delete("jobs/{$job_id}/photos/{$photo_id}");
    }

    // Worker Rates

    public function getWorkersRates(int $worker_id)
    {
        // code...
    }

    public function getWorkerRates(int $worker_id)
    {
        // code...
    }

    // Worker Claims

    public function claimWorkerForTeam(int $team_id, $params)
    {
        return $this->post("teams/{$team_id}/claim", $params);
    }

    public function deleteWorkerClaim(int $team_claim_id)
    {
        return $this->delete("team-claims/{$team_claim_id}");
    }

    // Add Worker To Team

    public function addWorkerToTeam(int $team, int $worker)
    {
        return $this->post("teams/{$team}/add-worker/{$worker}");
    }

    // Job Invites

    public function getJobInvites(int $job_id, array $params)
    {
        return $this->get("jobs/{$job_id}/job-invites", $params);
    }

    public function getWorkerJobInvites(int $worker_id, array $params = [])
    {
        return $this->get("workers/{$worker_id}/job-invites", $params);
    }

    public function createJobInvite(int $job_id, array $params)
    {
        return $this->post("teams/{$job_id}/team-invites", $params);
    }

    public function createJobInvites(int $job_id, array $params)
    {
        return $this->put("teams/{$job_id}/team-invites", $params);
    }

    public function deleteJobInvite(int $job_invite_id)
    {
        return $this->delete("job-invites/{$job_invite_id}");
    }

    // Job Requests

    public function getJobRequests(int $job_id, array $params = [])
    {
        return $this->get("jobs/{$job_id}/job-requests", $params);
    }

    public function getWorkerJobRequests(int $worker_id, array $params = [])
    {
        return $this->get("workers/{$worker_id}/job-requests", $params);
    }

    public function approveJobRequest(int $job_request_id)
    {
        return $this->post("job-requests/{$job_request_id}/approve");
    }

    public function declineJobRequest(int $job_request_id, array $params = [])
    {
        return $this->post("job-requests/{$job_request_id}/decline", $params);
    }

    // Employers

    public function getEmployers()
    {
        return $this->get('employers');
    }

    public function getEmployerPlaces(int $employer_id)
    {
        return $this->get('api/employers/places', ["employer_id" => $employer_id]);
    }

    public function canClaimWorker(int $employer_id, array $params)
    {
        return $this->post("employers/{$employer_id}/claim-status", $params);
    }

    // Payroll

    public function getPayrolls(int $place_id)
    {
        return $this->get("api/places/{$place_id}/payroll");
    }

    public function getPayroll(int $place_id, int $payroll_id)
    {
        return $this->get("api/places/{$place_id}/payroll/{$payroll_id}");
    }

    public function getPayrollLineItems(int $place_id, int $payroll_id, array $params = [])
    {
        return $this->get("api/places/{$place_id}/payroll/{$payroll_id}/line-items", $params);
    }

    public function getPayrollSummaryItems(int $place_id, int $payroll_id, array $params = [])
    {
        return $this->get("api/places/{$place_id}/payroll/{$payroll_id}/summary-items", $params);
    }

    // Places

    public function createPlace(array $params)
    {
        return $this->post('places/register', $params);
    }

    public function updatePlace(int $place_id, array $params)
    {
        return $this->put("places/{$place_id}", $params);
    }

    public function createLocation(int $place_id, array $params)
    {
        return $this->post("places/{$place_id}/locations", $params);
    }

    public function updateLocation(int $location_id, array $params)
    {
        return $this->put("locations/{$location_id}", $params);
    }

    public function deactivateLocation(int $location_id)
    {
        return $this->delete("locations/{$location_id}");
    }

    public function getLocationComplianceChecks(array $params)
    {
        return $this->get('compliance-checks', $params);
    }

    public function createWeeklyPayAdjustment(int $place_id, $params)
    {
        return $this->post("places/{$place_id}/worker-adjustments", $params);
    }

    public function updateWeeklyAdjustment(int $adjustment_id, $params)
    {
        return $this->put("worker-adjustments/{$adjustment_id}", $params);
    }

    public function deleteWeeklyAdjustment(int $adjustment_id)
    {
        return $this->delete("worker-adjustments/{$adjustment_id}");
    }

    // Positions

    public function getPositionRate(int $spur_team_id)
    {
        return $this->get("teams/{$spur_team_id}/rates");
    }

    public function getPositionsRate(array $teams)
    {
        return $this->post('teams/rates', $teams);
    }

    public function getPositions(array $params = [])
    {
        return $this->get('positions', $params);
    }

    // Punches

    public function createPunches(int $shift_id, array $params)
    {
        return $this->post("shifts/{$shift_id}/punches", $params);
    }

    public function getPunches(int $shift_id)
    {
        return $this->get("shifts/{$shift_id}/punches");
    }

    public function getShiftsToPunch(int $location_id, array $params)
    {
        return $this->get("locations/{$location_id}/kiosk", $params);
    }

    // Rates

    public function getRates(int $team_id, array $params)
    {
        return $this->get("teams/{$team_id}/rates", $params);
    }

    public function getRate(int $rate_id)
    {
        return $this->get("rates/{$rate_id}");
    }

    public function createRate(int $team_id, array $params)
    {
        return $this->post("teams/{$team_id}/rates", $params);
    }

    public function patchRate(int $rate_id, array $params)
    {
        return $this->patch("rates/{$rate_id}", $params);
    }

    public function deleteRate(int $rate_id)
    {
        return $this->delete("rates/{$rate_id}");
    }

    public function commitRate(int $rate_id)
    {
        return $this->put("rates/{$rate_id}/commit");
    }

    public function createRateRule(int $rate_id, array $params)
    {
        return $this->post("rates/{$rate_id}/rules", $params);
    }

    public function deleteRateRule(int $rate_rule_id)
    {
        return $this->delete("rate-rules/{$rate_rule_id}");
    }

    public function validateRate(int $team_id, array $params)
    {
        return $this->post("teams/{$team_id}/rates/validate", $params);
    }

    // Rate Modifiers

    public function getTeamRateModifiers(int $team_id)
    {
        return $this->get("teams/{$team_id}/rate-modifiers");
    }

    public function createTeamRateModifier(int $team_id, array $params)
    {
        return $this->post("teams/{$team_id}/rate-modifiers", $params);
    }

    public function getRateModifier(int $rate_modifier)
    {
        return $this->get("rate-modifiers/{$rate_modifier}");
    }

    public function patchRateModifier(int $rate_modifier, array $params)
    {
        return $this->patch("rate-modifiers/{$rate_modifier}", $params);
    }

    public function deleteRateModifier(int $rate_modifier_id)
    {
        return $this->delete("rate-modifiers/{$rate_modifier_id}");
    }

    // Ratings

    public function createRating(int $worker_id, int $shift_id, array $params)
    {
        return $this->post("workers/{$worker_id}/rate/{$shift_id}", $params);
    }

    // Shifts

    public function assignGig(int $gig_id, array $params)
    {
        return $this->post("/gigs/{$gig_id}/assign-worker", $params);
    }

    public function getAvailability(int $gig_id, array $params)
    {
        return $this->get("/gigs/{$gig_id}/worker-availability", $params);
    }

    public function getAvailabilityForWorker(int $gig_id, int $worker_id)
    {
        return $this->get("/gigs/{$gig_id}/worker-availability/{$worker_id}");
    }

    public function getDateAvailability(int $job_id, array $params)
    {
        return $this->post("/jobs/{$job_id}/worker-availability", $params);
    }

    public function getDateAvailabilityForWorker(int $job_id, int $worker_id, array $params)
    {
        return $this->post("/jobs/{$job_id}/worker-availability/{$worker_id}", $params);
    }

    public function updateGig(int $gig_id, array $params)
    {
        return $this->put("gigs/{$gig_id}/shifts", $params);
    }

    // Shifts

    public function getShift(int $shift_id)
    {
        return $this->get("shifts/{$shift_id}");
    }

    public function cancelShifts(array $params)
    {
        return $this->post('shifts/cancel', $params);
    }

    public function cancelShiftsByDateRange(array $params)
    {
        return $this->post('shifts/cancel-by-date-range', $params);
    }

    public function createShifts(int $team_id, array $params)
    {
        return $this->post("jobs/{$team_id}/shifts", $params);
    }

    public function reportShift(int $shift_id, array $params)
    {
        return $this->post("shifts/{$shift_id}/report", $params);
    }

    public function markNoShow(int $shift_id)
    {
        return $this->post("shifts/{$shift_id}/no-show", []);
    }

    public function updateShifts(array $params)
    {
        return $this->put('shifts', $params);
    }

    public function createShiftTip(int $shift_id, array $params)
    {
        return $this->post("shifts/{$shift_id}/workplace/tips", $params);
    }

    public function createTipsForShifts(array $params)
    {
        return $this->post('shifts/workplace/bulk-tips', $params);
    }

    // Awards

    public function createAwards(array $params)
    {
        return $this->post('shift-awards', $params);
    }

    public function updateAward(int $award_id, array $params)
    {
        return $this->put("awards/{$award_id}", $params);
    }

    public function deleteAward(int $award_id)
    {
        return $this->delete("awards/{$award_id}");
    }

    // Workers

    public function getBlockedWorkers(int $place_id, array $params)
    {
        return $this->get("places/{$place_id}/blocked-workers", $params);
    }

    public function blockWorker(int $place_id, array $params)
    {
        return $this->put("places/{$place_id}/block-worker", $params);
    }

    public function blockWorkerFromLocation(int $location_id, int $user_id)
    {
        return $this->post("locations/{$location_id}/blocked-workers/{$user_id}", []);
    }

    public function unblockWorkerFromLocation(int $location_id, int $user_id)
    {
        return $this->delete("locations/{$location_id}/blocked-workers/{$user_id}", []);
    }

    public function getWorker(int $worker_id, array $params = [])
    {
        return $this->get("workers/{$worker_id}", $params);
    }

    public function getWorkers(array $params)
    {
        return $this->get('workers', $params);
    }

    public function removeWorker(int $job_id, int $worker_id)
    {
        return $this->delete("jobs/{$job_id}/workers/{$worker_id}");
    }

    // Employees

    public function getLimitedEmployeesFromEmployer(int $employer_id, array $params = [])
    {
        return $this->get("api/employers/{$employer_id}/limited_employees", $params);
    }

    public function getLimitedEmployeeFromEmployer(int $employer_id, int $employee_id)
    {
        return $this->get("api/employers/{$employer_id}/limited_employees/{$employee_id}");
    }

    public function getLimitedEmployeesFromPlace(int $place_id, array $params = [])
    {
        return $this->get("api/places/{$place_id}/limited_employees", $params);
    }

    public function getLimitedEmployeeFromPlace(int $place_id, int $employee_id)
    {
        return $this->get("api/places/{$place_id}/limited_employees/{$employee_id}");
    }

    public function getLimitedEmployeesFromLocation(int $location_id, array $params = [])
    {
        return $this->get("api/locations/{$location_id}/limited_employees", $params);
    }

    public function getLimitedEmployeeFromLocation(int $location_id, int $employee_id)
    {
        return $this->get("api/locations/{$location_id}/limited_employees/{$employee_id}");
    }
}
