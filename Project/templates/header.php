<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlogSpace</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1 0 auto;
            padding: 20px 0;
        }

        footer {
            flex-shrink: 0;
            background-color: #f8f9fa;
            padding: 20px 0;
            text-align: center;
            margin-top: auto;
        }

        .articles-list {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .article-container {
            margin-bottom: 30px;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border: 1px solid #e9ecef;
        }

        .article-title {
            margin: 0 0 15px 0;
        }

        .article-title a {
            color: #333;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: bold;
            transition: color 0.2s;
        }

        .article-title a:hover {
            color: #007bff;
        }

        .meta {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .article-preview {
            margin: 15px 0;
            overflow: hidden;
            text-overflow: ellipsis;
            word-wrap: break-word;
        }

        .article-preview p {
            margin: 0;
            line-height: 1.6;
            color: #4a4a4a;
        }

        .read-more {
            display: inline-block;
            color: #007bff;
            text-decoration: none;
            margin-top: 10px;
            font-weight: 500;
        }

        .read-more:hover {
            text-decoration: underline;
            color: #0056b3;
        }

        .btn-add {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            transition: background-color 0.2s;
        }

        .btn-add:hover {
            background-color: #218838;
            color: white;
            text-decoration: none;
        }

        .comment {
            border: 1px solid #e9ecef;
        }

        .comment-date {
            font-size: 0.85rem;
        }

        .article-container {
            max-width: 900px;
            margin: 0 auto 30px;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border: 1px solid #e9ecef;
        }

        .article-container h1 {
            color: #333;
            margin-bottom: 1rem;
            word-wrap: break-word;
        }

        .article-container .lead {
            white-space: pre-wrap;
            word-wrap: break-word;
            overflow-wrap: break-word;
            line-height: 1.8;
            color: #4a4a4a;
        }

        .comments {
            max-width: 900px;
            margin: 2rem auto;
            padding: 0 20px;
        }

        .add-comment {
            max-width: 900px;
            margin: 2rem auto;
            padding: 0 20px;
        }

        .comment {
            background-color: #f8f9fa;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .comment p {
            margin-bottom: 0.5rem;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
    </style>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= $_SERVER['SCRIPT_NAME']; ?>">Articles</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="hello/denis">Hello!</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/article/create">Create Article</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">