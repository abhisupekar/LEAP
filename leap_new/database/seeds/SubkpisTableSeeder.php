<?php

use Illuminate\Database\Seeder;

class SubkpisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subkpis')->insert([
            ['name' => 'Reliability', 'description' => 'The very cornerstone of every software development project, this is a measure of the number of tasks/tickets completed, vs the number assigned.'],
            ['name' => 'Quality', 'description' => 'For every line of code written, we expect that it is tested thoroughly. Adequate unit tests should be written to test the functionality at a granular level, for testing, write enough functional tests to cover the intended functionality. There should be very little to none defect leakage to production, especially P1 or P2 defects. This metric will be a measure of number of defect issues or tickets reopened due to incomplete\deficient work'],
            ['name' => 'Knowledge Base', 'description' => 'For every feature that you are working on, you should create enough knowledge base articles for others reference. These can be consumed either by Customer Support team, or Product team or even other Engineering team members at a later stage.'],
            ['name' => 'Code Review Misses', 'description' => 'To ensure quaity code, code reviews will be initiated for every commit and a rigorous code review process followed. For team members, team lead will complete the code review; for team leads, Navin or Amit to complete code reviews. The measure will be on the number of code reviews that were not initiated/completed in a quarter.'],
            ['name' => 'Code Coverage(Team Score)', 'description' => 'Code Coverage instrumentation will be initiated for every module/product that you are working on. Once a baseline is established, efforts will be undertaken every quarter to improve the code coverage.(Team Score)'],
            ['name' => 'SLA Misses', 'description' => 'Team lead to define the SLAs to be followed by all team members. This metric is a measure of the tasks that could not be completed within the defined SLA'],
            ['name' => 'DevOps /Automation', 'description' => 'Besides working on assigned tasks, it is very important to detect improvements and areas of automation. These could be as small as writing a small script to eliminate manual tasks, deployed in production.'],
            ['name' => 'Value Adds', 'description' => 'Associates are encouraged to identify process improvements and recommend the same to the client. This is one of our key distinguising factors, and every associate is expected to work on and deliver the same.'],
            ['name' => 'Feedback/Scorecard/CSAT', 'description' => 'Client feedback will be solicited every 6 months to seek feedback about our teams. This feedback will be objective based on key points, and will be used as is for this measure.'],
            ['name' => 'Escalations', 'description' => 'Number of escalations due to being non-responsive or incorrect work received from the client. These escalation emails are generally sent to the Portfolio managers or Gaurav.'],
            ['name' => 'Basic Project Governance', 'description' => 'Leads are expected to manage project delivery in a smooth manner while ensuring communication with the key stakeholders is maintained. Key measurements:
                1) Timesheet approvals for all team members by EOM
                2) WSR reports emailed out to stakeholders by Monday noon
                3) KPIs are regularly measured and reported
                4) On time for all Meetings
                5) CSAT score from Onsite counterparts (measured on Communication, Leadership, Task Management, Mentoring and Empowerment, Team Building)'],
            ['name' => 'Timesheets', 'description' => 'On time timesheet submission (by Friday EOD)'],
            ['name' => 'Sales Contribution', 'description' => 'As our organization grows, our Sales team would need more help from the Delivery Leads in terms of attending calls, being part of Solution teams, helping with the proposals etc. There is ample opportunity for everyone to contribute towards this effort.'],
            ['name' => 'Interviews', 'description' => 'People are the most important asset of any organziation. As we form more teams, it is increasingly important to choose the right people ot join our company, and for this we need to be very selective in our interview process. This measure is the number of interviews that you could conduct during a quarter.'],
            ['name' => 'Mentoring', 'description' => 'It is ecpected of all leads to mentor junior associates by showing them a path, pointing them in the right direction. Please make yourselves (Leads and above) for this initiatve.'],
            ['name' => 'Technical Meet ups', 'description' => 'To remain current in your technical area, it is imperative you attend meetups or play a critical part in hosting one at our premises.'],
            ['name' => 'Initiatives', 'description' => 'To create a vibrant culture across the organization, we expect our associates to take initiatives for other associates in terms of technical or cultural events which can be sustained across a longer period of time.'],
            ['name' => 'Blogs / white papers', 'description' => 'As our associates gain more expertise/technical knowledge, it is expected they write blogs or white papers to pass on the same to the community. These blogs will also be featured on the company web-site and could be used as collaterals in the sales process.'],
            ['name' => 'Planned Leaves', 'description' => '% of leaves taken vs planned at least 1 month in advance'],
            ['name' => 'Innovation', 'description' => 'Innovation is the DNA of every budding organization. Associates are expected to innovate in what they do on a daily basis, it could be a small idea that got implemented or it could be something that could be patented.'],
            ['name' => 'Certifications', 'description' => 'It is imperative to keep oneself abreast of latest technologies, and certifications are a reflection of the same. Associates are encouraged to pursue certifications online (Udacity, Coursera, Edx etc.) or consult their practice heads to complete an official company paid certification.'],
            ['name' => 'Trainings Given', 'description' => 'Number of multi-day trainings conducted to benefit other teams.'],
            ['name' => 'Trainings Attendeed', 'description' => 'Several technical trainings will be offered on the floor by our associates, there will be opportunties to attend these or even present these.'],
            
            ['name' => 'Knowledge & Enablement', 'description' => 'Number of runbooks, checklist, procedures, process enhancement documents, presentations, project plans, change plans, architectural diagrams published after extensive observation, research and reviews. Qualifying document should provide direct process improvements by considerably improving day to day functioning of the team or customers. The documentation should follow with knowledge sharing  sessions ensuring widespread adoption.'],
            ['name' => 'Design & Architect A', 'description' => 'Number of "NEW" architectures presented, POC conducted, products evaluated, frameworks designed and implemented for new features, functionalities, operational improvements, automation, or sustenance.'],
            ['name' => 'Design & Architect B', 'description' => 'Number of business encounters recorded to gather technical requirements from clients/customers for new or expansion of scope. This excludes sprint planning, standups or such recurring interactions.'],
            ['name' => 'Build, Validate, & Deliver A', 'description' => '% of user stories or tickets delivered on time vs acknowledged or committed. Includes requests for new features, functionalities, or operational work coming from client or other teams.'],
            ['name' => 'Build, Validate, & Deliver B', 'description' => '% of user stories or tickets deliverd vs committed for operational improvements. Includes tickets created by the team.'],
            ['name' => 'Preventive Maintainence A', 'description' => 'Number of potential risks, bottleneck, or fail points identified and/or worked upon for better scalability, durability, availability, and reliability. This would be further fed into as a new ticket, user story, project, or change request and tracked till successful implementation.'],
            ['name' => 'Preventive Maintainence B', 'description' => 'Number of root causes fixed after due analysis. This should only inlcude the actions that result in widespread prevention, or result in true business impact, or reduce escalations or number of alerts significantly (>10%).'],
            ['name' => 'Reactive Maintainence A', 'description' => '% of alerts closed vs recieved within stipulated SLA.'],
            ['name' => 'Reactive Maintainence B', 'description' => '% of CMs or Planned Activities completed on time per SLA.'],
            ['name' => 'Reactive Maintainence C', 'description' => '% of Unplanned Activities completed satisfactorily as per SLA.']
        ]);
    }
}
