<?php

namespace Niazpardaz\Sms\Models;

/**
 * روش ارسال پیامک
 */
class SmsSendMethodType
{
    const None = -10;
    const Quick = 1;
    const Test = 2;
    const Regional = 3;
    const Group = 4;
    const WebService = 5;
    const Announcement = 6;
    const Secretary = 7;
    const IntelligentSend = 8;
    const CorrespondingSend = 9;
    const CodeReader = 10;
    const Poll = 11;
    const Transfer = 12;
    const Reply = 13;
    const PhoneBook = 14;
    const PostalCode = 15;
    const SmsEvent = 16;
    const IntelligentSecretary = 17;
    const AddToPhoneBook = 18;
    const InstantSms = 19;
    const ScheduleSms = 20;
    const UsanceSms = 21;
    const AgeAndGender = 22;
    const System = 23;
    const BirthdaySms = 24;
    const KioskSms = 25;
    const CancellationBy11 = 26;
}
