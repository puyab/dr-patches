"use server";

import { httpClient } from "@app/lib/axios";
import { cookies } from "next/headers";

export async function login(email: string, password: string): Promise<boolean> {
  try {
    const { status, data } = await httpClient.post("v1/authentication/login", {
      email,
      password,
    });
    if (status !== 201) throw new Error();
    cookies().set("jwt_token", data.token);
    return true;
  } catch (e) {
    return false;
  }
}

export async function register(payload: object) {
  try {
    const { status, data } = await httpClient.post(
      "v1/authentication/register",
      payload
    );
    if (status !== 201) throw new Error();
    cookies().set("jwt_token", data.token);
    return true;
  } catch (e: any) {
    return e.response.data.message[0];
  }
}
