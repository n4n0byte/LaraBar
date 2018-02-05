<?php
/*
version 1.0

Ali, Connor
CST-256
February 4, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/

?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/resources/assets/css/bootstrap.css">
    <script src="/resources/assets/js/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="/resources/assets/js/bootstrap.bundle.js"></script>
    <script src="/resources/assets/js/particles.js"></script>
    <title>Home</title>
</head>

<body>
<div class="container">
    <nav class="nav-pills">
        <ul class="nav nav-tabs justify-content-end  ">
            <li class="nav-item">
                <a class="nav-link" href="home">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="profile">Profile</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="logout">Log Out</a>
            </li>
            @if(isset($user) && $user->getAdmin())
                <li class="nav-item">
                    <a class="nav-link" href="admin">Administrator</a>
                </li>
            @endif
        </ul>
    </nav>
    <div class="admin-tool">
        <div class="list">
            <table>
                <tr>
                    <th>ID</th>
                    <th>EMAIL</th>
                    <th>Suspend</th>
                </tr>
                <?php
                /* @var $user \App\Model\UserModel */
                if (isset($userList))
                foreach ($userList as $user) {
                ?>
                <tr>
                    <td>@php echo $user->getId(); @endphp</td>
                    <td>@php echo $user->getEmail(); @endphp</td>
                    <td>
                        <a href="admin/suspend/<?php echo $user->getId(); ?>"></a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>