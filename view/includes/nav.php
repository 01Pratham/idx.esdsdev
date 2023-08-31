<?php $get_emp = employee($_SESSION['emp_code']) ;

include '../include/navbar.php';
include '../include/sidebar.php';

// <nav>
//     <div class="nav-content">
//         <div class='heading'>
//             <a href='https://www.esds.co.in/'><img src='../asset/logo.png' alt='logo'></a>
//         </div>
//         <ul class='nav-links'>
//             <li>
//                 <label>Hi,
//                     <?=$get_emp['first_name']." ".$get_emp['last_name']." ( ".$get_emp['employee_code']." )"
//                 </label>
//             </li>
//             <li>
//                 <a href="../controller/logout.php?logout">Logout</a>
//             </li>

//         </ul>
//     </div>
// </nav> 
?> 

