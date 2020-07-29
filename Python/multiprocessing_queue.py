import multiprocessing
import queue

def task(i):
    pass

def worker(q):
    while True:
        try:
            i = q.get_nowait()
        except queue.Empty:
            break
        else:
            task(i)

    return True

if __name__ == '__main__':
    q = multiprocessing.Queue()

    for x in range(0, 100):
        q.put(x)

    processes = []

    for x in range(multiprocessing.cpu_count()):
        p = multiprocessing.Process(target=worker, args=(q))
        processes.append(p)
        p.start()

    for p in processes:
        p.join()