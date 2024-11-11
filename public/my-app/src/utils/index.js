import qs from "qs";

const fetchWP = async (payload, action = "") => {
  // console.log("fetchWP has ajax_url:", ajax_url);
  // console.log("fetchWP has payload:", payload);

  let localHost = window.location.hostname.includes("localhost");

  console.log("fetchWP has localHost:", localHost);
  if (localHost) {
    let sleep = (ms) => new Promise((resolve) => setTimeout(resolve, ms));
    await sleep(3000);

    return {
      result: "success",
      message: "Form submitted successfully!",
      data: payload,
    };
  }

  let { ajax_url, inject_react_plugin_nonce } = getWindowData("inject_react_user_data");
  payload.inject_react_plugin_nonce = inject_react_plugin_nonce;
  payload.action = action;

  try {
    const res = await fetch(ajax_url, {
      credentials: "same-origin",
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded; charset=utf-8",
      },
      body: qs.stringify(payload), // Must be a f*cking query string for WP.
    });

    if (res.ok) {
      return res.json();
    } else {
      throw new Error("There was an Ajax error.");
    }
  } catch (err) {
    console.error("There was an Ajax error.");
    return err;
  }
};

function getWindowData(dataObj) {
  if (window[dataObj]) {
    return window[dataObj];
  }
  return {};
}

export default {
  fetchWP,
  getWindowData,
};
