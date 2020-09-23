@extends('web.layouts.app')
@section('title')
FAQ
@endsection
@section('content')
    <div class="container">
        <h4>Frequently Asked Questions</h4>
            <div class="row">
                <div class="col-lg-9">
                    <article class="entry single-entry">
                        <div class="entry-body">
                            <div class="entry-content editor-content">
                                <h5>General Questions</h5>
                                <ul>
                                        <li>
                                            What is the status of my order?:<br/>Once you have placed your order, we will send you a confirmation email to track the status of your order.
                                            Once your order is shipped we will send you another email to confirm you the expected delivery date as well as the link to track your order (when the delivery method allows it).
                                            Additionally, you can track the status of your order from your "order history" section on your account page on the website.
                                        </li>
                                        <li>
                                            Can i change my order?:<br/>We can only change orders that have not been processed for shipping yet.
                                            Once your order is under the status "preparing for shipping", "shipping" or "delivered", then we cannot accept any edits to your order.
                                            To make changes to your order, please reach out to support through the helpdesk.</li>
                                        <li>
                                            Where do you ship?:<br/>We currently ship within Lagos
                                            For shipping outside of Lagos, please reach out to our support through our helpdesk.</li>
                                    </ul>   
                                    
                                    <h5>Payment</h5>
                                    <ul>
                                        <li>
                                            What payment methods do you accept?:<br/>
                                            You can purchase on our website using a debit or credit card or pay on delivery
                                            You can chose these payment methods at checkout.
                                        </li>
                                        <li> Do you offer 3 or 4 times payment option?
                                            <br/>
                                            NO
                                        </li>
                                    </ul>

                                    <h5>Shipping</h5>
                                    <ul>
                                        <li>
                                            Where do you ship?:<br/>We currently ship within Lagos
                                            For shipping outside of Lagos, please reach out to our support through our helpdesk.
                                        </li>
                                        <li>How long does it take to ship my order?: <br/>
                                            Once you've placed your order, it usually takes 24 to 48 hours to 
                                            process it for delivery.
                                        </li>
                                        <li>How long does it take to ship my order?: <br/>
                                            Once you've placed your order, it usually takes 24 to 48 hours to 
                                            process it for delivery.
                                        </li>
                                        <li> How can I track my package?:<br/>
                                            Once you have placed your order, we will send you a confirmation email to track the status of your order. Feel free to call us anytime
                                        </li>
                                        <li>
                                            What if I'm not home?:<br/>
                                            If you're not home, a new delivery will be performed the next day or the delivery partner will reach out to schedule a new delivery date 
                                        </li>
                                    </ul>

                                    <h5>Other Questions</h5>
                                    <ul>
                                        <li>
                                            Do you accept returns?:<br/>
                                            We do accept returns in respect to the following conditions:
                                            <br>
                                            - The item must have been sold on our online store <br>
                                            - The item shouldn't have been used in any way <br>
                                            - The return or exchange request is made within a day of delivery <br>
                                            - The return is made within 2 days of the return or exchange request <br>
                                            To ask for a return, please contact our support using our helpdesk.
                                        </li>
                                        <li> Do you have physical stores?:<br/>
                                            Yes check out our <a href="{{route ('contactus')}}">contact page</a> to see our location
                                        </li>
                                    </ul>
                                </div>
                        </div>
                    </article>
                </div>
            </div>
    </div>
@endsection