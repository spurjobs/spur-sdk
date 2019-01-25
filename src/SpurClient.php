<?php

namespace Spur;

class SpurClient extends SpurClientBase
{
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

    // Jobs

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

    // Positions

    public function getPositions(array $params = [])
    {
        return $this->get('positions', $params);
    }

    // Punches

    public function getPunches(int $shift_id)
    {
        return $this->get("shifts/{$shift_id}/punches");
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

    public function cancelShifts(array $params)
    {
        return $this->post('shifts/cancel', $params);
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

    // Awards

    public function createAward(int $shift_id, array $params)
    {
        return $this->post("shifts/{$shift_id}/awards", $params);
    }

    public function updateAward(int $award_id, array $params)
    {
        $this->put("awards/{$award_id}", $params);
    }

    public function deleteAward(int $award_id)
    {
        $this->delete("awards/{$award_id}");
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
}
