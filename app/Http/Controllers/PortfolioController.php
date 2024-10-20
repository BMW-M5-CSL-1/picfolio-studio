<?php

namespace App\Http\Controllers;

use App\DataTables\CertificateEducationDataTable;
use App\DataTables\ProjectDataTable;
use App\DataTables\WorkExperienceDataTable;
use App\Models\CertificateEducation;
use App\Models\Portfolio;
use App\Models\Project;
use App\Models\WorkExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PortfolioController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        return DB::transaction(function () use ($request) {
            $user = auth()->user();
            // Create Portfolio
            // $portfolio = Portfolio::create([
            //     'user_id' => Auth::id(),
            // ]);

            // Save Work Experiences
            if ($request->has('work_repeater')) {
                foreach ($request->work_repeater as $work) {
                    $workExperience = WorkExperience::create([
                        'user_id' => $user->id,
                        'company_name' => $work['company_name'],
                        'job_title' => $work['job_title'],
                        'start_date' => $work['start_date'],
                        'end_date' => $work['end_date'],
                        'description' => $work['work_description']
                        // 'attachment' => $this->storeAttachment($workExperience['attachment']),
                    ]);
                    if (isset($work['attachment'])) {
                        $workExperience->addMedia($work['attachment'])->toMediaCollection('work_attachments');
                    }
                }
            }

            // Save Projects
            if ($request->has('project_repeater')) {
                foreach ($request->project_repeater as $project) {
                    $projectEntry = Project::create([
                        'user_id' => $user->id,
                        'name' => $project['project_name'],
                        'role' => $project['your_role'],
                        'start_date' => $project['start_date'],
                        'end_date' => $project['end_date'],
                        'description' => $project['project_description']
                    ]);
                    if (isset($project['project_attachment'])) {
                        $projectEntry->addMedia($project['project_attachment'])->toMediaCollection('project_attachments');
                    }
                }
            }

            // Save Certificates/Education
            if ($request->has('certificate_repeater')) {
                foreach ($request->certificate_repeater as $certificate) {
                    $certificateEntry = CertificateEducation::create([
                        'user_id' => $user->id,
                        'name' => $certificate['certificate_name'],
                        'institution' => $certificate['institute'],
                        'start_date' => $certificate['certificate_start_date'],
                        'end_date' => $certificate['certificate_end_date'],
                        'description' => $certificate['certificate_description']
                    ]);
                    if (isset($certificate['certificate_attachment'])) {
                        $certificateEntry->addMedia($certificate['certificate_attachment'])->toMediaCollection('certificate_attachments');
                    }
                }
            }

            return response()->json(['message' => 'Portfolio created successfully']);
        });
    }

    public function showProject($id, ProjectDataTable $table)
    {
        $data = [
            'user_id' => $id,
        ];
        return $table->with($data)->ajax();
    }

    public function showWork($id, WorkExperienceDataTable $table)
    {
        $data = [
            'user_id' => $id,
        ];
        return $table->with($data)->ajax();
    }

    public function showCertificate($id, CertificateEducationDataTable $table)
    {
        $data = [
            'user_id' => $id,
        ];
        return $table->with($data)->ajax();
    }

    public function delete($id, $type)
    {
        return DB::transaction(function () use ($id, $type) {
            if ($type == 'certificate') {
                $certificate = CertificateEducation::find($id);
                if ($certificate) {
                    $certificate->delete();
                    return response()->json(['message' => 'Certificate deleted successfully']);
                } else {
                    return response()->json(['message' => 'Data Not Found !'], 500);
                }
            } elseif ($type == 'work') {
                $work = WorkExperience::find($id);
                if ($work) {
                    $work->delete();
                    return response()->json(['message' => 'Work experience deleted successfully']);
                } else {
                    return response()->json(['message' => 'Data Not Found !'], 500);
                }
            } elseif ($type == 'project') {
                $project = Project::find($id);
                if ($project) {
                    $project->delete();
                    return response()->json(['message' => 'Project deleted successfully']);
                } else {
                    return response()->json(['message' => 'Data Not Found !'], 500);
                }
            } else {
                return response()->json(['message' => 'No such record found'], 500);
            }
        });
    }
}
