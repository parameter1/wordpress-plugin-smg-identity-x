/*global fetch*/
const { PROCESSOR_API_KEY, PROCESSOR_ENDPOINT } = process.env;
const { log } = console;

exports.handler = async (event) => {
  const { Records = [] } = event;
  const r = await fetch(PROCESSOR_ENDPOINT, {
    method: 'post',
    headers: {
      'content-type': 'application/json',
      authorization: `Bearer ${PROCESSOR_API_KEY}`,
    },
    body: JSON.stringify(Records),
  });
  if (!r.ok) throw new Error(`Processing unsuccessful: ${r.status} ${r.statusText}`);
  const { batchItemFailures = [], errors } = await r.json();
  log(`${batchItemFailures.length} / ${Records.length} failed.`, errors);
  return { batchItemFailures };
};
