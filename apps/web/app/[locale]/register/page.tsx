"use client";

import { register } from "@app/actions/auth";
import Button from "@app/components/Button";
import Input from "@app/components/Input";
import Link from "@app/components/Link";
import { PhoneInput } from "react-international-phone";
import { toast } from "react-toastify";

async function registerWithErrors(formData: FormData) {
  const payload: { [key: string]: string } = {};
  for (const key of [...formData.keys()])
    payload[key] = formData.get(key) as string;
  const result = await register(payload);
  if (result === true) {
    toast.success("You registered successfully");
    setTimeout(() => (window.location.href = "/"), 1000);
  } else toast.error(result);
}

export default function RegisterPage() {
  return (
    <div className="w-full h-full flex-auto flex items-center justify-center my-10 lg:my-20 px-6 lg:px-12">
      <div className="w-11/12 mx-auto h-max max-w-3xl bg-black border-primary-1 border-2 py-10 px-8 rounded-xl text-white flex flex-col items-center justify-center gap-10">
        <h2 className="font-bold text-2xl lg:text-3xl">Register</h2>
        <form
          action={registerWithErrors}
          className="w-full h-max flex flex-col gap-6 bg-primary-1 p-6 rounded-md"
        >
          <div className="w-full h-max grid grid-cols-1 md:grid-cols-2 gap-6">
            <Input label="First Name" name="firstName" type="text" required />
            <Input label="Last Name" name="lastName" type="text" required />
          </div>
          <Input label="Email" name="email" type="email" required />
          <Input label="Password" name="password" type="password" required />
          <PhoneInput
            className="bg-white w-full rounded-md"
            inputClassName="w-full"
            required
            name="phone"
          />
          <select
            placeholder="Gender"
            className="w-full h-8 text-black font-semibold px-4 rounded-md text-sm"
            name="gender"
          >
            <option value="m">Male</option>
            <option value="f">Female</option>
          </select>
          <Button>Register</Button>
          <div className="w-max mx-auto font-semibold underline text-black">
            <Link href="/login">Already have one?</Link>
          </div>
        </form>
      </div>
    </div>
  );
}
