<?php
/*
version 1.0

Connor/Ali
CST-256
March 16, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/
/* @var $searchResults array
 * @var $result \App\Model\JobModel
 */

?>
<div class="row" id="results">
    <table class="table table-bordered table-hover" style="background-color: rgba(255,255,255,.8); ">
        <tr>
            <th>What</th>
            <th>Who</th>
            <th>Where</th>
            <th>Salary</th>
            <th>Actions</th>
        </tr>
        @foreach($searchResults as $job)
            <tr>
                <td>
                    {{$job->getTitle()}}
                </td>
                <td>
                    {{$job->getAuthor()}}
                </td>
                <td>
                    {{$job->getLocation()}}
                </td>
                <td>
                    ${{$job->getSalary()}}
                </td>
                <td>
                    @component("components.buttons.btn", ["title" => "apply",
                     "route" => "view_job/" . $job->getId(),
                      "class" => "fa-arrow-circle-right"])
                    @endcomponent
                    @component("components.buttons.btn", ["title" => "save",
                     "route" => "view_job/" . $job->getId(),
                      "class" => "fa-bookmark-o"])
                    @endcomponent
                </td>
            </tr>
        @endforeach
    </table>
</div>
