<?php

header('Content-Type: application/json');

$db = mysqli_connect('localhost', 'root', '', 'angularjs');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $name = $data['name'];
    $phone = $data['phone'];

    if (empty($name) || empty($phone)) {
        http_response_code(400);
        echo json_encode(['message' => 'Vui lòng nhập đầy đủ thông tin']);
        return;
    }

    $query = $db->prepare('INSERT INTO contacts (name, phone) VALUES (?, ?)');
    $query->bind_param('ss', $name, $phone);

    if ($query->execute()) {
        http_response_code(201);
        echo json_encode(['message' => 'Thêm mới thành công']);
    } else {
        http_response_code(500);
        echo json_encode(['message' => 'Có lỗi xảy ra']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = $db->prepare('SELECT * FROM contacts WHERE id = ?');
        $query->bind_param('i', $id);
        $query->execute();
        $result = $query->get_result();
        $contact = $result->fetch_assoc();

        echo json_encode($contact);
    } else {
        $query = $db->prepare('SELECT * FROM contacts');
        $query->execute();
        $result = $query->get_result();
        $contacts = $result->fetch_all(MYSQLI_ASSOC);

        echo json_encode($contacts);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'];

    $query = $db->prepare('DELETE FROM contacts WHERE id = ?');
    $query->bind_param('i', $id);

    if ($query->execute()) {
        http_response_code(200);
        echo json_encode(['message' => 'Xóa thành công']);
    } else {
        http_response_code(500);
        echo json_encode(['message' => 'Có lỗi xảy ra']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);

    $id = $_GET['id'];
    $name = $data['name'];
    $phone = $data['phone'];

    if (empty($name) || empty($phone)) {
        http_response_code(400);
        echo json_encode(['message' => 'Vui lòng nhập đầy đủ thông tin']);
        return;
    }

    $query = $db->prepare('UPDATE contacts SET name = ?, phone = ? WHERE id = ?');
    $query->bind_param('ssi', $name, $phone, $id);

    if ($query->execute()) {
        http_response_code(200);
        echo json_encode(['message' => 'Cập nhật thành công']);
    } else {
        http_response_code(500);
        echo json_encode(['message' => 'Có lỗi xảy ra']);
    }
}

