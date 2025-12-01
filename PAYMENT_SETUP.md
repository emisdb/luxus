# Payment Setup Guide

This guide will help you configure both Mollie and Stripe payment gateways for the Luxus payment system.

## Table of Contents
1. [Stripe Configuration](#stripe-configuration)
2. [Mollie Configuration](#mollie-configuration)
3. [Environment Variables](#environment-variables)
4. [Testing](#testing)

---

## Stripe Configuration

### Step 1: Get Your Stripe API Keys

1. **Log in to your Stripe Dashboard**
   - Go to [https://dashboard.stripe.com](https://dashboard.stripe.com)
   - Sign in with your Stripe account credentials

2. **Navigate to API Keys**
   - Click on **"Developers"** in the left sidebar menu
   - Click on **"API keys"** under the Developers section
   - You'll see two keys:
     - **Publishable key** (starts with `pk_test_` for test mode or `pk_live_` for live mode)
     - **Secret key** (starts with `sk_test_` for test mode or `sk_live_` for live mode)

3. **Copy Your Secret Key**
   - Click the **"Reveal test key"** or **"Reveal live key"** button next to the Secret key
   - Copy the entire key (it will look like: `sk_test_51Q...` or `sk_live_51Q...`)
   - **Important**: Keep this key secure and never share it publicly

4. **Switch Between Test and Live Mode**
   - Use the toggle switch in the top right of the Stripe Dashboard
   - **Test mode**: Use for development and testing (keys start with `test_`)
   - **Live mode**: Use for production (keys start with `live_`)

### Step 2: Set Up Stripe Webhook

1. **Navigate to Webhooks**
   - In the Stripe Dashboard, go to **"Developers"** → **"Webhooks"**
   - Click the **"+ Add endpoint"** button

2. **Configure Webhook Endpoint**
   - **Endpoint URL**: Enter your webhook URL:
     ```
     https://your-domain.com/payment/webhook/stripe
     ```
     Replace `your-domain.com` with your actual domain name
   
   - **Description**: Enter a description like "Luxus Payment Webhook"

3. **Select Events to Listen To**
   - Click **"Select events"**
   - Check the following event:
     - ✅ `checkout.session.completed` (under "Checkout" section)
   - Click **"Add events"**

4. **Save and Get Webhook Secret**
   - Click **"Add endpoint"** to save
   - After creating the endpoint, click on it to view details
   - In the **"Signing secret"** section, click **"Reveal"**
   - Copy the webhook signing secret (starts with `whsec_...`)
   - This is your `STRIPE_WEBHOOK_SECRET`

### Step 3: Test Your Webhook (Optional but Recommended)

1. **Send Test Webhook**
   - In the webhook details page, click **"Send test webhook"**
   - Select `checkout.session.completed` event
   - Click **"Send test webhook"**
   - Check your application logs to verify it's received correctly

---

## Mollie Configuration

### Step 1: Get Your Mollie API Key

1. **Log in to your Mollie Dashboard**
   - Go to [https://www.mollie.com/dashboard](https://www.mollie.com/dashboard)
   - Sign in with your Mollie account credentials

2. **Navigate to Developers → API Keys**
   - Click on **"Developers"** in the top menu
   - Click on **"API keys"** in the dropdown
   - You'll see your API keys listed

3. **Copy Your API Key**
   - For testing: Use the **"Test"** API key (starts with `test_`)
   - For production: Use the **"Live"** API key (starts with `live_`)
   - Click the copy icon or manually copy the key
   - **Important**: Keep this key secure and never share it publicly

4. **Switch Between Test and Live Mode**
   - Use the toggle switch in the Mollie Dashboard
   - **Test mode**: Use for development and testing
   - **Live mode**: Use for production

---

## Environment Variables

Add the following variables to your `.env` file:

```env
# Stripe Configuration
STRIPE_SECRET_KEY=sk_test_your_stripe_secret_key_here
STRIPE_WEBHOOK_SECRET=whsec_your_webhook_secret_here

# Mollie Configuration
MOLLIE_API_KEY=test_your_mollie_api_key_here
```

### Where to Find Each Value:

| Variable | Where to Find It |
|----------|----------------|
| `STRIPE_SECRET_KEY` | Stripe Dashboard → Developers → API keys → Secret key (Reveal test/live key) |
| `STRIPE_WEBHOOK_SECRET` | Stripe Dashboard → Developers → Webhooks → [Your endpoint] → Signing secret (Reveal) |
| `MOLLIE_API_KEY` | Mollie Dashboard → Developers → API keys → Test/Live key |

### Important Notes:

- **Never commit your `.env` file** to version control
- **Use test keys** during development
- **Switch to live keys** only when going to production
- **Keep your keys secure** - treat them like passwords

---

## Testing

### Test Stripe Payment:

1. Use Stripe test card numbers:
   - **Success**: `4242 4242 4242 4242`
   - **Decline**: `4000 0000 0000 0002`
   - Use any future expiry date (e.g., 12/25)
   - Use any 3-digit CVC
   - Use any postal code

2. Test the payment flow:
   - Go to the Payment page in your application
   - Select "Stripe" as payment method
   - Enter an amount between 10-100 EUR
   - Use a test card number
   - Complete the payment

### Test Mollie Payment:

1. Use Mollie test mode:
   - Mollie will provide test payment methods in test mode
   - Follow the payment flow as normal

### Verify Webhook:

1. Check your application logs after a successful payment
2. Verify the webhook is being received correctly
3. Test with Stripe's webhook testing tool in the Dashboard

---

## Troubleshooting

### Stripe Issues:

- **"Invalid API Key"**: Verify your `STRIPE_SECRET_KEY` is correct and starts with `sk_test_` or `sk_live_`
- **Webhook not working**: 
  - Verify the webhook URL is accessible from the internet
  - Check that `STRIPE_WEBHOOK_SECRET` matches the signing secret in your Stripe Dashboard
  - Ensure CSRF protection is disabled for the webhook route (already configured)

### Mollie Issues:

- **"Invalid API Key"**: Verify your `MOLLIE_API_KEY` is correct
- **Payment not redirecting**: Check that the redirect URL in the code matches your domain

### General Issues:

- **Composer dependencies**: Run `composer install` to ensure Stripe PHP SDK is installed
- **Cache issues**: Run `php artisan config:clear` after updating `.env` file

---

## Security Best Practices

1. ✅ Use environment variables for all API keys
2. ✅ Never expose API keys in client-side code
3. ✅ Use HTTPS for all payment-related endpoints
4. ✅ Validate webhook signatures (already implemented)
5. ✅ Use test mode during development
6. ✅ Monitor your Stripe/Mollie dashboards for suspicious activity
7. ✅ Rotate API keys periodically
8. ✅ Keep your dependencies up to date

---

## Support

For additional help:
- **Stripe Documentation**: [https://stripe.com/docs](https://stripe.com/docs)
- **Mollie Documentation**: [https://docs.mollie.com](https://docs.mollie.com)
- **Stripe Support**: Available in your Stripe Dashboard
- **Mollie Support**: Available in your Mollie Dashboard

