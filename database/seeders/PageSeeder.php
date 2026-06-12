<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pages')->insert([
            [
                "name" => "faq",
                "slug" => "faq",
                "title" => "Frequently Asked Questions",
                "content" => "<h2>1. General Questions</h2><p>Find answers to common questions about our platform and offerings.</p>"
            ],
            [
                "name" => "privacy-policy",
                "slug" => "privacy-policy",
                "title" => "Privacy Policy",
                "content" => '<h2>1. Introduction</h2><p>Welcome to <strong>StackMaster</strong>. We are committed to protecting your personal information and your right to privacy. This Privacy Policy details how we collect, use, and protect your information when you visit our website and purchase our services or products.</p><h2>2. Information We Collect</h2><p>We collect personal information that you voluntarily provide to us when placing an order, enrolling in a course, or contacting us. This information may include:</p><ul><li>Name and contact details (email, phone, address)</li><li>Payment information and transaction details (e.g., bKash/Nagad number and Transaction ID)</li><li>IP address and usage data collected automatically when navigating our site</li></ul><h2>3. How We Use Your Information</h2><p>We use the information we collect to:</p><ul><li>Process and manage your orders and course enrollments</li><li>Provide user support and handle inquiries</li><li>Send updates, news, and promotional communications (if subscribed)</li><li>Improve our services and prevent fraudulent transactions</li></ul><h2>4. Payment Security & Verification</h2><p>When you purchase products or enroll in courses, we offer manual payment verification via bKash and Nagad. Your payment details (phone numbers and transaction IDs) are used solely to confirm transaction authenticity with our payment processors.</p><h2>5. Your Rights</h2><p>You have the right to request access to the personal data we hold about you, request corrections to incorrect data, or request the deletion of your personal records. For inquiries, please contact us at our official email.</p>'
            ],
            [
                "name" => "terms-conditions",
                "slug" => "terms-conditions",
                "title" => "Terms & Conditions",
                "content" => '<h2>1. Acceptance of Terms</h2><p>By accessing and purchasing from <strong>StackMaster</strong>, you agree to comply with and be bound by the following Terms and Conditions. Please review them carefully.</p><h2>2. Services and Products</h2><p>We provide educational courses (such as the MSM Course), digital products, gadgets, and antique collections. We reserve the right to modify or discontinue any product or service at any time without notice.</p><h2>3. Ordering and Payment Policy</h2><p>All orders placed through our website require manual payment verification. Payments must be sent via bKash or Nagad to the designated number. You must provide a valid Transaction ID for your order to be processed and completed.</p><h2>4. Refund and Cancellation</h2><p>Since we offer digital products and courses, all sales are final. Refunds are only issued under exceptional circumstances or if we fail to deliver the requested product/service. Please contact support within 24 hours of purchase if you encounter issues.</p><h2>5. Intellectual Property</h2><p>All course materials, website layout, graphics, code, and digital assets are the intellectual property of StackMaster. You may not copy, distribute, or resell any of our materials without explicit written consent.</p><h2>6. Limitation of Liability</h2><p>In no event shall StackMaster be liable for any indirect, incidental, or consequential damages arising out of the use or inability to use our products or services.</p>'
            ]
        ]);
    }
}
