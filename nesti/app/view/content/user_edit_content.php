<?php
if (!isset($user) || empty($user)) {
    $user = new User();
}
?>
<div class="container bg-white align-items-left position-relative" id="userEditPage">

    <div class="d-flex flex-row underLink">
        <a href="<?= BASE_URL ?>user"><u>Users</u>
        </a>
        <p> &nbsp; > Edit</p>
    </div>
    <!-- div notif user edit -->
    <div id="userEditSuccess" class="notifications" hidden>
        <p>User's information have been successfully edited in the database</p>
    </div>

    <!-- div notif password reset -->
    <div id="userPasswordResetSuccess" class="notifications" hidden>
    </div>
    <div class="d-flex flex-row justify-content-lg-between justify-content-center flex-wrap">
        <div class="col-lg-4 col-12">
            <div class="d-flex flex-column">
                <h2 class="mb-2 mt-2">User Edit</h2>
                <form method="POST" action="<?= BASE_URL ?>user/edituser" class="application px-5 px-md-0" id="editUserForm">

                    <div class="row mb-2">
                        <label for="inputUserEditLastname">Lastname *</label>
                        <input type="text" class="form-control" id="inputUserEditLastname" name="userLastname" value="<?= $user->getLastname() ?>">
                    </div>
                    <span class="text-danger" id="errorUserEditLastname"></span>

                    <div class=" row mb-2">
                        <label for="inputUserEditFirstname">Firstname *</label>
                        <input type="text" class="form-control" id="inputUserEditFirstname" name="userFirstname" value="<?= $user->getFirstname() ?>">
                    </div>
                    <span class="text-danger" id="errorUserEditFirstname"></span>

                    <div class=" row mb-2">
                        <label for="inputUserEditAddress1">Address *</label>
                        <input type="text" class="form-control" id="inputUserEditAddress1" name="userAddress1" value="<?= $user->getAddress1() ?>">
                    </div>
                    <span class="text-danger" id="errorUserEditAddress1"></span>

                    <div class="row mb-2">
                        <label for="inputUserEditAddress2">Additional address</label>
                        <input type="text" class="form-control" id="inputUserEditAddress2" name="userAddress2" value="<?= $user->getAddress2() ?>">
                    </div>
                    <span class="text-danger" id="errorUserEditAddress2"></span>

                    <div class="row mb-2">
                        <label for="inputUserEditCity">City *</label>
                        <input type="text" class="form-control" id="inputUserEditCity" name="userCity" value='<?= $user->getCity()->getCityName() ?>'>
                    </div>
                    <span class="text-danger" id="errorUserEditCity"></span>

                    <div class="row mb-2">
                        <label for="inputUserEditPostcode">Postcode *</label>
                        <input type="text" class="form-control" id="inputUserEditPostcode" name="userPostcode" value="<?= $user->getPostCode() ?>">
                    </div>
                    <span class="text-danger" id="errorUserEditPostcode"></span>

                    <div class="row justify-content-around">

                        <div class="d-flex flex-column">
                            <div>
                                <label>Role(s) *</label>
                            </div>
                            <div>
                                <input type="checkbox" id="admin" name="userRoles[]" value="admin" <?php foreach ($user->getRoles() as $role) {
                                                                                                        if ($role == 'admin') {
                                                                                                            echo 'checked';
                                                                                                        };
                                                                                                    }; ?>>


                                <label for="admin"> Administrator </label>
                            </div>
                            <div>
                                <input type="checkbox" id="mod" name="userRoles[]" value="moderator" <?php foreach ($user->getRoles() as $role) {
                                                                                                            if ($role == 'moderator') {
                                                                                                                echo 'checked';
                                                                                                            };
                                                                                                        }; ?>>
                                <label for="mod"> Moderator </label>
                            </div>
                            <div>
                                <input type="checkbox" id="chief" name="userRoles[]" value="chief" <?php foreach ($user->getRoles() as $role) {
                                                                                                        if ($role == 'chief') {
                                                                                                            echo 'checked';
                                                                                                        };
                                                                                                    }; ?>>
                                <label for="chief"> Chief </label>
                            </div>
                        </div>

                        <div class="d-flex flex-column">
                            <div>
                                <label for="userEditState">State *</label>
                            </div>
                            <div>
                                <select name="userState" id="userEditState">
                                    <option value="a" <?php if ($user->getState() == 'a') {
                                                            echo 'selected';
                                                        }; ?>>Active</option>
                                    <option value="b" <?php if ($user->getState() == 'b') {
                                                            echo 'selected';
                                                        }; ?>>Blocked</option>
                                    <option value="w" <?php if ($user->getState() == 'w') {
                                                            echo 'selected';
                                                        }; ?>>Waiting</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger" id="errorUserEditRoles"></span>
                    <input type="text" class="form-control" name="id_user" id="idUser" value="<?= $user->getIdUser() ?>" hidden>
                    <div class="row d-flex justify-content-around mt-2">
                        <button id="submitEditUser" class="btn" data-toggle="modal" type="button" data-target="#modalEditUser">Submit</button>
                        <div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitleUpdateUser" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ModalCenterTitleUpdateUser">Do you really want to update this user's information ?</h5>
                                        <button type="button" class="close" id="closeModalEdit" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-footer">
                                        <button id="confirm-edit" class="btn" type="submit">Confirm</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button id="cancelEditUser" class="btn" type="reset">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-lg-6 p-0 mt-4 mt-lg-0">
            <div class="d-flex flex-column justify-content-center align-items-start mb-2">


                <h2>Informations</h2>

                <div class="list border w-100 d-flex flex-column pl-2 pt-2 pb-2">
                    <p> <b>Email :</b> <?= $user->getEmail() ?> </p>
                    <p> Creation Date : <?= $user->getDisplayDate() ?> </p>
                    <p> Last connection : <?= $user->getLog()->getDisplayDate() ?></p>

                    <?php $userRoles = $user->getRoles() ?>
                    <?php
                    if (array_search('chief', $userRoles) !== false || array_search('oldChief', $userRoles) !== false) { ?>


                        <p class="font-weight-bold"> Chief </p>
                        <p>Number of recipes : <?= count($user->getRecipes()) ?> </p>
                        <p>Last recipe : <?= $user->getLastRecipe()->getRecipeName() ?> </p>

                    <?php
                    }
                    if (array_search('user', $userRoles) !== false) { ?>

                        <p class="font-weight-bold"> User </p>
                        <p>Number of orders : <?= count($user->getOrders()) ?></p>
                        <p>Total amount of orders : <?= $user->getTotalAmountOrders() ?> €</p>
                        <p> Last order : <?= $user->getLastOrder()->getAmount() ?> €</p>

                    <?php
                    }
                    if (array_search('admin', $userRoles) !== false || array_search('oldAdmin', $userRoles) !== false) { ?>

                        <p class="font-weight-bold"> Administrator </p>
                        <p> Number of import : <?= count($user->getImports()) ?> </p>
                        <p> Last import : <?= $user->getLastImport()->getDisplayDate() ?> </p>


                    <?php
                    }
                    if (array_search('moderator', $userRoles) !== false || array_search('oldModerator', $userRoles) !== false) { ?>


                        <p class="font-weight-bold"> Moderator </p>
                        <p>Number of approved comments : <?= $user->getCommentsNumber()["approved"] ?> </p>
                        <p> Number of blocked comments : <?= $user->getCommentsNumber()["blocked"] ?> </p>

                    <?php
                    }

                    ?>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-lg btn-info w-100" data-toggle="modal" data-target="#modalResetPassword">
                    Reset Password
                </button>
            </div>
            <div class="modal fade" id="modalResetPassword" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitleResetPassword" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalCenterTitleResetPassword">Reset Password</h5>
                            <button type="button" class="close" id="closeModalResetPassword" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            You are about to change this user's password.
                            This action is definitive and irreversible.
                            <br><br>
                            Are you sure that you want to do it ?
                        </div>
                        <div class="modal-footer">
                            <button id="confirm-reset-password" class="btn" type="submit" data-id="<?= $user->getIdUser() ?>" onclick="resetPassword()">Confirm</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (array_search("admin", $_SESSION["roles"]) !== false) {

    ?>
        <div class="d-flex flex-column mt-3 mt-lg-3">
            <div>
                <h1>His orders</h1>
                <h5>Consultation of his orders</h5>
            </div>
            <div class="d-flex flex-row justify-content-lg-around justify-content-center flex-wrap">
                <div class="col-12 col-lg-8">
                    <div class="wrapper-articles-table justify-content-between">
                        <div>
                            <div class="d-flex flex-row justify-content-between">
                                <nav class="navbar navbar-white bg-white pl-0">
                                    <form class="form-inline">
                                        <input class="form-control mr-sm-2" id="customSearchOrderUser" type="search" placeholder="Search" aria-label="Search">
                                        <img id="searchOrderUser" src="<?php echo BASE_URL . PATH_ICONS ?>search-svg.svg" alt="">
                                    </form>
                                </nav>

                            </div>
                            <table class="table-borderless table-striped" id="allOrdersUserTable" data-toggle="table" data-sortable="true" data-pagination="true" data-pagination-pre-text="Previous" data-pagination-next-text="Next" data-search="true" data-search-align="left" data-search-selector="#customSearchOrderUser" data-locale="eu-EU" data-toolbar="#toolbar" data-toolbar-align="left">
                                <thead>
                                    <tr>
                                        <th>ID</th>

                                        <th>User</th>

                                        <th>Amount</th>

                                        <th>Number of articles</th>

                                        <th>Date</th>

                                        <th>State</th>
                                    </tr>
                                </thead>
                                <tbody id="allOrdersTbody">
                                    <?php
                                    $orders = $user->getOrders();
                                    foreach ($orders as $order) {
                                        echo '<tr class="orders" data-id="' . $order->getIdOrder() . '">';
                                        echo '<td>' . $order->getIdOrder() . '</td>';
                                        echo '<td>' . $order->getUser()->getFirstName() . " " . $order->getUser()->getLastName() . '</td>';
                                        echo '<td>' . round(($order->getAmount()), 2) . '</td>';
                                        echo '<td>' . $order->getNumberOfArticle() . '</td>';
                                        echo '<td>' . $order->getDisplayDate() . '</td>';
                                        echo '<td>' . $order->getDisplayState() . '</td>';
                                        echo '</tr>';
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-6 col-lg-4 mb-3 mb-lg-0 mt-4 mt-lg-0">
                    <div class="d-flex justify-content-between px-xl-3 align-items-end">
                        <h2>Details</h2>
                        <div id="userOrderId" class="d-flex justify-content-center align-items-center orderId">
                            <h4 id="idOrderUser">N°:</h4>
                        </div>

                    </div>
                    <div id="listOrderLinesUser" class="d-flex flex-column justify-content-start w-100 p-2 bg-white border">
                    </div>
                </div>

            </div>
        </div>
    <?php } ?>

    <br>

    <div class="d-flex flex-column position-relative">
        <!-- div notif user edit -->
        <div id="commentApprovedSuccess" class="notifications" hidden>
            <p>The comment has been approved</p>
        </div>
        <div id="commentBlockedSuccess" class="notifications" hidden>
            <p>The comment has been blocked</p>
        </div>
        <h1>His comments</h1>
        <h5>Moderation of his comments</h5>
        <br>
        <div class="d-flex flex-row">
            <div class="col-12">
                <div class="d-flex flex-row justify-content-between">
                    <nav class="navbar navbar-white bg-white pl-0">
                        <form class="form-inline">
                            <input class="form-control mr-sm-2" id="customSearchCommentUser" type="search" placeholder="Search" aria-label="Search">
                            <img id="searchCommentUser" src="<?php echo BASE_URL . PATH_ICONS ?>search-svg.svg" alt="">
                        </form>
                    </nav>

                </div>
                <table class="table-borderless table-striped" id="allCommentsUserTable" data-toggle="table" data-sortable="true" data-pagination="true" data-pagination-pre-text="Previous" data-pagination-next-text="Next" data-search="true" data-search-align="left" data-search-selector="#customSearchCommentUser" data-locale="eu-EU" data-toolbar="#toolbar" data-toolbar-align="left">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Recipe</th>
                            <th>Content</th>
                            <th>Date</th>
                            <th>State</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="allCommentsTbody">
                        <?php
                        foreach ($user->getComments() as $comment) {
                        ?>
                            <tr data-id='<?= $comment->getIdComment() ?>'>
                                <th>
                                    <?= $comment->getIdComment() ?>
                                </th>
                                <td>
                                    <?= $comment->getCommentTitle() ?>
                                </td>
                                <td>
                                    <?= $comment->getRecipe()->getRecipeName() ?>
                                </td>
                                <td>
                                    <?= $comment->getCommentContent() ?>
                                </td>
                                <td>
                                    <?= $comment->getDisplayDate() ?>
                                </td>
                                <td>
                                    <?= $comment->getDisplayState(); ?>
                                </td>

                                <td>
                                    <a class="btn-approve-comment" data-toggle="modal" data-target="#modalApproveComment<?= $comment->getIdComment() ?>">
                                        Approve
                                    </a>
                                    <div class="modal fade" id="modalApproveComment<?= $comment->getIdComment() ?>" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitleApproveComment<?= $comment->getIdComment() ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ModalCenterTitleApproveComment<?= $comment->getIdComment() ?>">Do you want to approve this comment ?</h5>
                                                    <button type="button" class="close" id="closeModalApprove<?= $comment->getIdComment() ?>" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn confirm-approve" data-id="<?= $comment->getIdComment() ?>" onclick='changeState("a")'>Confirm</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <a class="btn-block-comment" data-toggle="modal" data-target="#modalBlockComment<?= $comment->getIdComment() ?>">
                                        Block
                                    </a>
                                    <div class="modal fade" id="modalBlockComment<?= $comment->getIdComment() ?>" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitleBlockComment<?= $comment->getIdComment() ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ModalCenterTitleBlockComment<?= $comment->getIdComment() ?>">Do you want to block this comment ?</h5>
                                                    <button type="button" class="close" id="closeModalBlock<?= $comment->getIdComment() ?>" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn confirm-block" data-id="<?= $comment->getIdComment() ?>" onclick='changeState("b")'>Confirm</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        <?php
                        }
                        ?>

                    </tbody>
                </table>
                <br>
            </div>
        </div>
    </div>

</div>

<script>
    const ROOT = '<?= BASE_URL ?>';
</script>