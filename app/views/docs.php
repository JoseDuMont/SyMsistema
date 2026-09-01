<?php

$role = $_SESSION['role'] ?? 'nivel1';
?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>
        Centro Documental — SDI
    </title>

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <style>

        body {

            font-family: Arial, sans-serif;

            margin: 0;

            background: #f4f6f8;

            color: #222;
        }

        header {

            background: #20252b;

            color: white;

            padding: 20px;
        }

        header h1 {

            margin: 0;

        }

        header p {

            margin: 5px 0 0;

            opacity: .8;

        }

        main {

            max-width: 1300px;

            margin: 30px auto;

            padding: 0 20px;

        }

        .layout {

            display: grid;

            grid-template-columns: 280px 1fr;

            gap: 20px;

        }

        .panel {

            background: white;

            border-radius: 8px;

            padding: 20px;

            box-shadow:
                0 2px 8px rgba(0,0,0,.08);

        }

        .documents {

            display: flex;

            flex-direction: column;

            gap: 10px;

        }

        .document {

            display: block;

            text-decoration: none;

            color: #222;

            padding: 14px;

            border-radius: 6px;

            border: 1px solid #ddd;

            background: #fafafa;

        }

        .document:hover {

            background: #eee;

        }

        .document.active {

            background: #20252b;

            color: white;

        }

        .document-title {

            font-weight: bold;

        }

        .document-description {

            font-size: 12px;

            margin-top: 5px;

            opacity: .7;

        }

        textarea {

            width: 100%;

            min-height: 650px;

            box-sizing: border-box;

            padding: 15px;

            font-family: monospace;

            font-size: 14px;

            line-height: 1.5;

            resize: vertical;

            border: 1px solid #ccc;

            border-radius: 6px;

        }

        .toolbar {

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 15px;

        }

        button {

            background: #222;

            color: white;

            border: 0;

            padding: 10px 18px;

            border-radius: 5px;

            cursor: pointer;

        }

        button:hover {

            opacity: .85;

        }

        .success {

            background: #dff6e4;

            color: #176b2c;

            padding: 12px;

            border-radius: 5px;

            margin-bottom: 15px;

        }

        .error {

            background: #fde2e2;

            color: #8a1c1c;

            padding: 12px;

            border-radius: 5px;

            margin-bottom: 15px;

        }

        .readonly {

            background: #eee;

            padding: 12px;

            border-radius: 5px;

            margin-bottom: 15px;

        }

        .role {

            font-size: 13px;

            opacity: .7;

        }

        @media (max-width: 800px) {

            .layout {

                grid-template-columns: 1fr;

            }

        }

    </style>

</head>


<body>


<header>

    <h1>
        🏛️ Centro Documental SDI
    </h1>

    <p>
        Documentación, infraestructura y memoria del sistema
    </p>

</header>


<main>


<div class="layout">


    <!-- =====================================================
         DOCUMENTOS
         ================================================== -->

    <aside class="panel">

        <h2>
            📚 Documentos
        </h2>

        <div class="documents">


            <?php foreach ($documents as $key => $doc): ?>

                <a
                    class="document <?= $selected === $key ? 'active' : '' ?>"
                    href="/docs?file=<?= urlencode($key) ?>"
                >

                    <div class="document-title">

                        <?= $doc['icon'] ?>

                        <?= htmlspecialchars($doc['name']) ?>

                    </div>

                    <div class="document-description">

                        <?= htmlspecialchars($doc['description']) ?>

                    </div>

                </a>

            <?php endforeach; ?>


        </div>

    </aside>


    <!-- =====================================================
         CONTENIDO
         ================================================== -->

    <section class="panel">


        <div class="toolbar">


            <div>

                <strong>

                    <?= $document['icon'] ?>

                    <?= htmlspecialchars($document['name']) ?>

                </strong>

                <br>

                <span class="role">

                    Nivel:
                    <?= htmlspecialchars($role) ?>

                </span>

            </div>


            <?php if ($canEdit): ?>

                <button form="docs-form">

                    💾 Guardar cambios

                </button>

            <?php endif; ?>


        </div>


        <?php if ($saved): ?>

            <div class="success">

                ✅ Documento actualizado correctamente.

            </div>

        <?php endif; ?>


        <?php if ($error): ?>

            <div class="error">

                ❌
                <?= htmlspecialchars($error) ?>

            </div>

        <?php endif; ?>


        <?php if (!$canEdit): ?>

            <div class="readonly">

                👁️
                Este documento está disponible
                en modo lectura.

            </div>

        <?php endif; ?>


        <form
            id="docs-form"
            method="POST"
            action="/docs?file=<?= urlencode($selected) ?>"
        >

            <textarea
                name="content"
                <?= $canEdit ? '' : 'readonly' ?>
            ><?= htmlspecialchars($content) ?></textarea>

        </form>


    </section>


</div>


</main>


</body>

</html>
