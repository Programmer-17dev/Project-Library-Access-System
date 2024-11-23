<div class="content">
    <div class="checkin-form">
        <div class="input-form">
            <form action="add_user_checkin.php" method="post">
                <p class="label-add" for="userID">บันทึกสถิติผู้เข้าใช้บริการห้องสมุด</p>
                <input type="text" id="userIDInput" name="userID" maxlength="20" required>
                <!-- ตรวจสอบและแสดงค่า $_SESSION['status'] -->
                <input type="hidden" name="status_place" value="<?php echo isset($_SESSION['status']) ? htmlspecialchars($_SESSION['status']) : ''; ?>" maxlength="1" required>
                <input type="submit" class="btn-submit" value="เข้าใช้บริการ">
            </form>
        </div>

        <div class="check-information" id="checkInformation">
            <?php
            if (isset($_SESSION['userID']) && isset($_SESSION['firstName']) && isset($_SESSION['lastName']) && isset($_SESSION['faculty'])) {
                $userID = $_SESSION['userID'];
                $firstName = $_SESSION['firstName'];
                $lastName = $_SESSION['lastName'];
                $branch = $_SESSION['branch'];
                $faculty = $_SESSION['faculty'];
                $level = $_SESSION['level'];

                echo "<span style='color: #fff; display: block; padding: 5px;'>รหัสผู้ใช้ : " . htmlspecialchars($userID) . "</span>";
                echo "<span style='color: #fff; display: block; padding: 5px;'>ชื่อ : " . htmlspecialchars($firstName) . " " . htmlspecialchars($lastName) . "</span>";
                echo "<span style='color: #fff; display: block; padding: 5px;'>" . htmlspecialchars($faculty) . "</span>";

                // ลบข้อมูลผู้ใช้จากเซสชันหลังแสดงผล
                unset($_SESSION['userID']);
                unset($_SESSION['firstName']);
                unset($_SESSION['lastName']);
                unset($_SESSION['branch']);
                unset($_SESSION['faculty']);
                unset($_SESSION['level']);
            } elseif (isset($_SESSION['error'])) {
                echo htmlspecialchars($_SESSION['error']);
                unset($_SESSION['error']);
            }
            ?>
        </div>
    </div>

    <!-- ตารางแสดงข้อมูลผู้เข้าใช้บริการ -->
    <div class="into-checkin">
        <table class="content-table">
            <thead>
                <tr>
                    <th>รหัสผู้ใช้</th>
                    <th>ชื่อผู้ใช้</th>
                    <th>นามสกุลผู้ใช้</th>
                    <th>เวลาเข้าใช้บริการ</th>
                    <th>คณะ</th>
                    <th>ระดับ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $limit = 7;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $start = ($page - 1) * $limit;

                $where_clause = $status == 1 ? "WHERE checkin.status_place = 1" : "WHERE checkin.status_place = 2";

                $sql_checkin = " SELECT 
                                           checkin.CheckIn_ID,
                                           checkin.CheckInTime,
                                           users.UserID,
                                           users.FirstName,
                                           users.LastName,
                                           branch.BranchName,
                                           faculty.FacultyName,
                                           level.LevelName
                                       FROM 
                                           checkin
                                       JOIN 
                                           users ON checkin.UserID = users.UserID
                                       JOIN 
                                           branch ON users.BranchID = branch.BranchID
                                       JOIN 
                                           faculty ON users.FacultyID = faculty.FacultyID
                                       JOIN 
                                           level ON users.Level_ID = level.Level_ID
                                       $where_clause AND DATE(checkin.CheckInTime) = CURDATE()
                                       ORDER BY checkin.CheckInTime DESC
                                       LIMIT $start, $limit";

                $stmt_checkin = $conn->prepare($sql_checkin);
                $stmt_checkin->execute();
                $result_checkin = $stmt_checkin->get_result();

                while ($row = $result_checkin->fetch_assoc()) {
                    $highlightClass = (isset($_SESSION['latestCheckIn']) && $row['CheckIn_ID'] == $_SESSION['latestCheckIn']) ? "class='highlight-row'" : "";
                    echo "<tr $highlightClass>";
                    echo "<td>" . htmlspecialchars($row['UserID']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['FirstName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['LastName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['CheckInTime']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['FacultyName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['LevelName']) . "</td>";
                    echo "<td>";
                    if (isset($_SESSION['latestCheckIn']) && $_SESSION['latestCheckIn'] == $row['CheckIn_ID']) {
                        echo "<span class='new-entry;' style='color: red;' >ล่าสุด</span>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }

                $stmt_checkin->close();
                
                ?>
            </tbody>
        </table>

        <div class="pagination">
            <?php
            $sql_count = "SELECT COUNT(*) AS total FROM checkin $where_clause AND DATE(CheckInTime) = CURDATE()";
            $result_count = mysqli_query($conn, $sql_count);
            $total = $result_count->fetch_assoc()['total'];
            $pages = ceil($total / $limit);

            echo "<span class='page'> หน้าที่ " . $page . " จาก " . $pages . " หน้า </span>";

            if ($pages <= 5) {
                $start_page = 1;
                $end_page = $pages;
            } else {
                if ($page <= 3) {
                    $start_page = 1;
                    $end_page = 5;
                } elseif ($page + 2 >= $pages) {
                    $start_page = $pages - 4;
                    $end_page = $pages;
                } else {
                    $start_page = $page - 2;
                    $end_page = $page + 2;
                }
            }

            if ($page > 1) {
                echo "<a href='index.php?page=1' class='arrow'>&laquo;</a> ";
                echo "<a href='index.php?page=" . ($page - 1) . "' class='arrow'>Previous</a> ";
            }

            for ($i = $start_page; $i <= $end_page; $i++) {
                echo "<a href='index.php?page=" . $i . "' class='test " . ($page == $i ? 'active' : '') . "'>" . $i . "</a> ";
            }

            if ($page < $pages) {
                echo "<a href='index.php?page=" . ($page + 1) . "' class='arrow'>Next</a> ";
                echo "<a href='index.php?page=" . $pages . "' class='arrow'>&raquo;</a> ";
            }
            ?>
        </div>
    </div>
</div>
</div>