<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h3>Data Alumni UMAHA</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Tahun</th>
                <th>Email</th>
                <th>No HP</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $i => $row): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= $row['nim'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['program_studi'] ?></td>
                    <td><?= $row['tahun_lulus'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['no_hp'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>