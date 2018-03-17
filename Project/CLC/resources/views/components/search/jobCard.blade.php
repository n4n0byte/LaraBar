<?php
/*  @var $job \App\Model\JobModel */
?>
<div class="col col-md-6">
    <div class="card mt-8 card-outline-secondary" style="width: 100% ;">

        <div class="card-header">
            <h2>{{$job->getTitle()}}</h2>
        </div>
        <div class="card-body" style="background: white; padding: 5px;">
            <div class="card-block">
                <h4>Posted by: {{$job->getAuthor()}}</h4>
                <h4>Location: {{$job->getLocation()}}</h4>
                <h4>Salary: {{$job->getSalary()}}</h4>
            </div>
            <div class="card-block">
                <h4>Description</h4>
                <p>{{$job->getDescription()}}</p>
            </div>
            <div class="card-block">
                <h4>Requirements</h4>
                <p>{{$job->getRequirements()}}</p>
            </div>
        </div>
        <div class="card-footer" style="display: inline-block;">
            <a href="#"
               onclick="document.getElementById('confirm-icon').setAttribute('style', 'font-size: 24px; visibility: visible');
               return confirm('Successfully applied! is what we would say, were this implemented.')">
                Apply now
            </a><span id="confirm-icon" style="font-size: 24px; visibility: hidden" class="fa fa-check"></span>
        </div>
    </div>
</div>