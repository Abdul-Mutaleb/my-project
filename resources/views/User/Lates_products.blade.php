<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Latest Flight Deals</title>

<style>
body {
  margin: 0;
  background: #eef5ff;
  font-family: Arial, Helvetica, sans-serif;
}

.flight-section {
  max-width: 900px;
  margin: 60px auto;
  background: #f6faff;
  padding: 30px;
  border-radius: 14px;
}

.flight-section h2 {
  margin: 0;
  font-size: 22px;
}

.subtitle {
  font-size: 13px;
  color: #6b7280;
  margin: 6px 0 22px;
}

.flight-card {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #ffffff;
  padding: 16px 20px;
  margin-bottom: 14px;
  border-radius: 10px;
  box-shadow: 0 4px 14px rgba(0,0,0,0.06);
}

.left {
  display: flex;
  align-items: center;
  gap: 14px;
}

.icon {
  width: 34px;
  height: 34px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  color: #fff;
}

.red { background: #ef4444; }
.blue { background: #3b82f6; }
.green { background: #22c55e; }

.route {
  font-size: 14px;
  font-weight: 600;
}

.route small {
  display: block;
  font-size: 11px;
  font-weight: normal;
  color: #6b7280;
  margin-top: 4px;
}

.right {
  display: flex;
  align-items: center;
  gap: 20px;
}

.price {
  text-align: right;
}

.price span {
  font-size: 11px;
  color: #6b7280;
  display: block;
}

.price strong {
  font-size: 18px;
  color: #1e3a8a;
}

button {
  background: #2563eb;
  border: none;
  color: #fff;
  padding: 8px 16px;
  border-radius: 8px;
  cursor: pointer;
  font-size: 13px;
}

button:hover {
  background: #1e40af;
}

@media (max-width: 600px) {
  .flight-card {
    flex-direction: column;
    gap: 14px;
    text-align: center;
  }
  .right {
    flex-direction: column;
    gap: 10px;
  }
}
</style>
</head>

<body>

<section class="flight-section">
  <h2 class='text-center'>Latest Flight Deals</h2>
  <p class="subtitle text-center">
    Exclusive rates for our partners and members. Contact us to book.
  </p>

  <div class="flight-card">
    <div class="left">
      <div class="icon red">✈</div>
      <div class="route">
        New York (JFK) → London (LHR)
        <small>Direct Flight • 10h 30m</small>
      </div>
    </div>
    <div class="right">
      <div class="price">
        <span>Offer Price</span>
        <strong>$450</strong>
      </div>
      <button>Contact Us</button>
    </div>
  </div>

  <div class="flight-card">
    <div class="left">
      <div class="icon blue">✈</div>
      <div class="route">
        Dubai (DXB) → Singapore (SIN)
        <small>Direct Flight • 7h 15m</small>
      </div>
    </div>
    <div class="right">
      <div class="price">
        <span>Offer Price</span>
        <strong>$320</strong>
      </div>
      <button>Contact Us</button>
    </div>
  </div>

  <div class="flight-card">
    <div class="left">
      <div class="icon green">✈</div>
      <div class="route">
        Tokyo (NRT) → Los Angeles (LAX)
        <small>Direct Flight • 10h 05m</small>
      </div>
    </div>
    <div class="right">
      <div class="price">
        <span>Offer Price</span>
        <strong>$780</strong>
      </div>
      <button>Contact Us</button>
    </div>
  </div>

</section>

</body>
</html>
