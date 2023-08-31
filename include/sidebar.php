<aside class="main-sidebar sidebar-light-primary elevation-4">
    <a href="" class="brand-link mt-2">
        <img src="../include/dist/img/logo.png" alt="ESDS Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Configurator</span>
    </a>
    <div class="except sidebar">
        <div class="except user-panel mt-3 pb-2 mb-3 d-flex">
            <div class="except image">
                <img src="../include/dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="except info">
                <input type="checkbox" id="profileHead" class="head-btn d-none" oninput="if($(this).prop('checked')){ $('#collapseExample').removeClass('hiddenDiv') ; $('#collapseExample').addClass('show')} else {$('#collapseExample').removeClass('show') ; $('#collapseExample').addClass('hiddenDiv')}">
                <label class="text-left btn border-0" for="profileHead" id="profile_<?= $id ?>" style="z-index: 1;">
                    <?= $get_emp['first_name'] . " " . $get_emp['last_name'] ?>
                </label>
                <div class="hiddenDiv except" id="collapseExample">
                    <div class=" card-body except">
                        <a href="../controller/logout.php"><span class="fas fa-sign-out-alt mr-2"> </span>Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="index.php" class="nav-link active">
                        <i class="nav-icon fas fa-th"></i>
                        <p class="except">
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?all" class="nav-link" id="allEstms">
                        <i class="nav-icon fa fa-folder-open"></i>
                        <p class="except">
                            Saved Quotations
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?create_new" class="nav-link" id="create">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p class="except">
                            Create New
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?users" class="nav-link" id="teamUsers">
                        <i class="nav-icon fas fa-users"></i>
                        <p class="except">
                            Team
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?rateCard" class="nav-link" id="rateCard">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p class="except">
                            Rate Card
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>