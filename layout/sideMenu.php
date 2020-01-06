<?
// require_once '../dbconn.php';
// $conn = new DBC();
// $conn->DBI();
//
// $sql = "select en_name from Account_member where idx = '".$_SESSION['id']."'";
// $conn->DBQ($sql);
// $conn->DBE();
// $row = $conn->DBF();

$sideMenu =
'
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="mypage.php"><img src="img/ui-sam.jpg" class="img-circle" width="80"></a></p>
          <h5 class="centered">user</h5>
          <li class="mt">
            <a href="dashBoard.php">
              <i class="fa fa-dashboard"></i>
              <span>대시보드</span>
              </a>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-desktop"></i>
              <span>기초관리</span>
              </a>
            <ul class="sub">
              <li><a href="company.php">거래처</a></li>
              <li><a href="store.php">매장</a></li>
              <li><a href="warehouse.php">창고</a></li>
              <li><a href="product.php">상품</a></li>
        <li><a href="manager.php">직원</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-cogs"></i>
              <span>구매관리</span>
              </a>
            <ul class="sub">
              <li><a href="orderbook.php">발주 조회</a></li>
              <li><a href="orderbook_total.php">발주 현황</a></li>
              <li><a href="purchase.php">매입 조회 </a></li>
              <li><a href="purchase_total.php">매입 현황</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-book"></i>
              <span>판매관리</span>
              </a>
            <ul class="sub">
              <li><a href="order.php">주문 조회</a></li>
              <li><a href="order_total.php">주문 현황</a></li>
              <li><a href="sale.php">매출 조회 </a></li>
              <li><a href="sale_total.php">매출 현황</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-krw"></i>
              <span>입/출금관리</span>
              </a>
            <ul class="sub">
              <li><a href="deposit.php">입금 조회</a></li>
              <li><a href="spend.php">출금 조회</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-tasks"></i>
              <span>재고관리</span>
              </a>
            <ul class="sub">
              <li><a href="stockInput.php">입고 조회</a></li>
              <li><a href="stockOutput.php">출고 조회</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-th"></i>
              <span>고객관리</span>
              </a>
            <ul class="sub">
              <li><a href="customer.php">고객 조회</a></li>
              <li><a href="customer_sale.php">판매 내역</a></li>
            </ul>
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
';
?>
