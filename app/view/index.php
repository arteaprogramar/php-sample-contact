<?php

    $source = new \app\domain\cases\GetAllContacts();
    /** @var \app\domain\entity\BaseResponse $data  */
    $data = $source -> execute() -> getResponse();

?>

<!DOCTYPE html>
<html data-theme="light">
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/sass/themes/light.scss">

</head>

<body>
<nav class="navbar" role="navigation" aria-label="main navigation">

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item title">
                Contactos
            </a>
        </div>
    </div>
</nav>
<div class="container p-6">
    <?php if (isset($_SESSION['message'])):  ?>
        <form  method="POST" action="index.php?route=session_remove" class="pb-4">
            <article class="message is-primary">
                <div class="message-header">
                    <p><?= $_SESSION['message']  ?></p>
                    <button class="delete" aria-label="delete" type="submit"></button>
                </div>
            </article>
        </form>
    <?php endif; ?>

    <section class="columns">
        <div class="column is-flex is-align-items-end is-justify-content-end">
            <button class="button is-primary js-modal-trigger" data-target="modal-js-example" onclick='onCreateContact("<?= ACTION_CREATE ?>")'>
                Crear Contacto
            </button>
        </div>
    </section>

    <section class="notification mg-medium">

        <div class="card-content">
            <?php /** @var \app\domain\entity\ContactEntity $value **/?>
            <?php  foreach ($data -> data as $index => $value):  ?>
            <div class="columns p-1">
                <div class="column is-four-fifths">
                    <div class="media">
                        <div class="media-left">
                            <span class="tag is-rounded  is-info is-large"><?= $value -> getNick()  ?></span>
                        </div>
                        <div class="media-content pl-5">
                            <p class="title is-4"><?= $value -> getName().' '. $value -> getFirstName() ?></p>
                            <p class="subtitle is-6"><?= $value -> getPhone() ?></p>
                        </div>
                    </div>
                </div>
                <div class="column is-flex is-align-items-end is-justify-content-end">
                    <button class="button js-modal-trigger" data-target="modal-js-example" onclick='onUpdateContact(<?= $value -> toString() ?>)'>
                        Editar
                    </button>
                </div>
            </div>
            <?php endforeach;  ?>

        </div>

    </section>
</div>

<!-- Modal para crear un contacto -->
<div id="modal-js-example" class="modal">
    <div class="modal-background"></div>

    <div class="modal-content">
        <form class="box" method="POST" action="index.php?route=sync">
            <div class="is-size-4 pb-2 has-text-weight-semibold" id="title">Título</div>

            <input class="input is-hidden" name="action" id="action" value="create" readonly required>
            <input class="input is-hidden" name="id" id="id" type="number" placeholder="Text input" value="0"  readonly required>

            <div class="field">
                <label class="label">Nombre</label>
                <div class="control">
                    <input class="input" name="name" id="name" type="text" placeholder="Text input" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Apellidos</label>
                <div class="control">
                    <input class="input" name="first_name" id="first_name" type="text" placeholder="Text input">
                </div>
            </div>

            <div class="field">
                <label class="label">Teléfono</label>
                <div class="control">
                    <input class="input" name="phone" id="phone" type="number" placeholder="Text input"  required>
                </div>
            </div>

            <div class="field">
                <label class="label">Correo</label>
                <input class="input is-danger" name="email" id="email" type="email" placeholder="Email input" value="hello@sample.com"  required>
            </div>


            <div class="field is-grouped">
                <div class="control">
                    <button class="button is-link" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <button class="modal-close is-large" aria-label="close"></button>
</div>

<script type="application/javascript">
    function onUpdateContact(entity) {
        document.querySelector("#title").textContent = "Actualizar contacto";
        document.querySelector("#action").value = '<?= ACTION_UPDATE ?>';
        document.querySelector('#id').value = entity.id;
        document.querySelector('#name').value = entity.name;
        document.querySelector('#first_name').value = entity.first_name;
        document.querySelector('#phone').value = entity.phone;
        document.querySelector('#email').value = entity.email;
    }

    function onCreateContact(action) {
        document.querySelector("#title").textContent = "Crear nuevo contacto";
        document.querySelector("#action").value = action;
        document.querySelector('#id').value = 0;
        document.querySelector('#name').value = '';
        document.querySelector('#first_name').value = '';
        document.querySelector('#phone').value = '';
        document.querySelector('#email').value = '';
    }

    document.addEventListener('DOMContentLoaded', () => {

        // Functions to open and close a modal
        function openModal($el) {
            $el.classList.add('is-active');
        }

        function closeModal($el) {
            $el.classList.remove('is-active');
        }

        function closeAllModals() {
            (document.querySelectorAll('.modal') || []).forEach(($modal) => {
                closeModal($modal);
            });
        }

        // Add a click event on buttons to open a specific modal
        (document.querySelectorAll('.js-modal-trigger') || []).forEach(($trigger) => {
            const modal = $trigger.dataset.target;
            const $target = document.getElementById(modal);

            $trigger.addEventListener('click', () => {
                openModal($target);
            });
        });

        // Add a click event on various child elements to close the parent modal
        (document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button') || []).forEach(($close) => {
            const $target = $close.closest('.modal');

            $close.addEventListener('click', () => {
                closeModal($target);
            });
        });

        // Add a keyboard event to close all modals
        document.addEventListener('keydown', (event) => {
            if(event.key === "Escape") {
                closeAllModals();
            }
        });
    });
</script>

</body>
</html>
